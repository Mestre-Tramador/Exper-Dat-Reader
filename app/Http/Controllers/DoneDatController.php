<?php

#region License
/**
 * Exper-Dat-Reader is a system to read encrypted .dat files and dump their data into .done.dat files.
 *  Copyright (C) 2022  Mestre-Tramador
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

use App\Models\{Dat, DoneDat};

use Carbon\Carbon;

/**
 * Controller to handle requests of the CRUD **(except Update)**
 * of `.done.dat` files, also list them.
 *
 * @author Mestre-Tramador
 */
class DoneDatController extends Controller
{
    /**
     * The storage path to `.done.dat` files.
     *
     * @var string
     */
    private const PATH_OUT = 'data/out';

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function list()
    {
        return $this->respondWithOK(DoneDat::get()->toArray());
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
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

        if($lastDump)
        {
            $dats = $dats->where('created_at', '>', $lastDump->created_at);
        }

        /** @var \Illuminate\Database\Eloquent\Collection<Dat> */
        $dats = $dats->get();

        if($dats->count() == 0)
        {
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

        if(!$doneDat->save())
        {
            return $this->respondWithServerError('Could not save file');
        }

        if
        (
            !app('storage')::disk('local')->append(
                self::PATH_OUT."/{$doneDat->name}",
                DoneDat::stringify($dump)
            )
        )
        {
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
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function read($id)
    {
        /**
         * The DoneDat file.
         *
         * @var DoneDat|null $doneDat
         */
        $doneDat = DoneDat::find($id);

        if(!$doneDat || $doneDat->deleted_at)
        {
            return $this->respondWithNotFound('File');
        }

        return $this->respondWithOK($doneDat->read());
    }

    /**
     * Delete the referenced DoneDat by the `$id`.
     *
     * Currently it is a *soft* delete, so the database row nor the
     * `.done.dat` file are really deleted.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        /**
         * The DoneDat file.
         *
         * @var DoneDat|null $doneDat
         */
        $doneDat = DoneDat::find($id);

        if(!$doneDat || $doneDat->deleted_at)
        {
            return $this->respondWithNotFound('File');
        }

        $doneDat->deleted_at = Carbon::now();

        if(!$doneDat->save())
        {
            return $this->respondWithServerError('File was not saved');
        }

        return $this->respondWithOK(['deleted' => $doneDat->name]);
    }
}
