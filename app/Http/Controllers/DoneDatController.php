<?php

#region License
/**
 * Exper-Dat-Reader is a system to read encrypted .dat files and dump their data into .done.dat files.
 *  Copyright (C) 2023  Mestre-Tramador
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */
#endregion

namespace App\Http\Controllers;

use App\Models\Dat;
use App\Models\DoneDat;
use App\Models\Util\FilePaths;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

/**
 * Controller to handle requests of the CRUD **(except Update)**
 * of `.done.dat` files, also list them.
 *
 * @author Mestre-Tramador
 */
class DoneDatController extends Controller
{
    use FilePaths;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Lists all current stored `.done.dat` files.
     *
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        return $this->respondWithOK(
            DoneDat::get()->toArray()
        );
    }

    /**
     * Get all current `.dat` files that were add after the last dump,
     * then read them and proceed to create a `.done.dat` file with
     * the data.
     *
     * The dumped data is:
     * * The customers quantity;
     * * The sellers quantity;
     * * The most expensive sale;
     * * The worst seller.
     *
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        /**
         * A list of all `.dat` files stored after the last dump.
         *
         * @var \Illuminate\Database\Eloquent\Builder $dats
         */
        $dats = Dat::query();

        /**
         * The last dumped `.done.dat` file.
         *
         * @var DoneDat|null $lastDump
         */
        $lastDump = DoneDat::orderBy('created_at', 'DESC')->first();

        if ($lastDump) {
            $dats = $dats->where('created_at', '>', $lastDump->created_at);
        }

        /** @var \Illuminate\Database\Eloquent\Collection<Dat> */
        $dats = $dats->get();

        if ($dats->count() == 0) {
            return $this->respondWithAccepted('No newer Dat files');
        }

        /**
         * The dumped data.
         *
         * Includes:
         * * The customers quantity;
         * * The sellers quantity;
         * * The most expensive sale;
         * * The worst seller.
         *
         * @var array $dump
         */
        $dump = DoneDat::dump($dats);

        /**
         * A new `.done.dat` file to store.
         *
         * @var DoneDat $doneDat
         */
        $doneDat = new DoneDat();

        if (!$doneDat->save()) {
            return $this->respondWithServerError('Could not save file');
        }

        if (
            !app('storage')::disk('local')->append(
                "{$this->getDataPath()}/{$doneDat->name}",
                DoneDat::stringify($dump)
            )
        ) {
            $doneDat->forceDelete();

            return $this->respondWithServerError('File was not stored');
        }

        return $this->respondWithCreated(
            [
                'name' => $doneDat->name,
                'data' => $doneDat->read()
            ]
        );
    }

    /**
     * Read a stored `.done.dat` file with the given ID.
     *
     * @param  int $id
     * @return JsonResponse
     */
    public function read(int $id): JsonResponse
    {
        return $this->readResponse(DoneDat::find($id));
    }

    /**
     * Read the last stored `.done.dat` file.
     *
     * @return JsonResponse
     */
    public function last(): JsonResponse
    {
        return $this->readResponse(
            DoneDat::orderBy('created_at', 'desc')->first()
        );
    }

    /**
     * Delete the referenced DoneDat by the `$id`.
     *
     * Currently it is a *soft* delete, so the database row nor the
     * `.done.dat` file are really deleted.
     *
     * @param  int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        /**
         * The DoneDat file.
         *
         * @var DoneDat|null $doneDat
         */
        $doneDat = DoneDat::find($id);

        if (!$doneDat || $doneDat->deleted_at) {
            return $this->respondWithNotFound('File');
        }

        $doneDat->deleted_at = Carbon::now();

        if (!$doneDat->save()) {
            return $this->respondWithServerError('File was not saved');
        }

        return $this->respondWithOK(['deleted' => $doneDat->name]);
    }

    /**
     * Return a JSON response based on the passed `.done.dat` file,
     * either valid or not.
     *
     * @param  DoneDat|null $doneDat
     * @return JsonResponse
     */
    private function readResponse(?DoneDat $doneDat): JsonResponse
    {
        if (!$doneDat || $doneDat->deleted_at) {
            return $this->respondWithNotFound('File');
        }

        return $this->respondWithOK($doneDat->read());
    }
}
