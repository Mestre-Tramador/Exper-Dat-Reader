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
use App\Models\Util\FilePaths;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Controller to handle requests of the CRUD of
 * `.dat` files, also list them.
 *
 * @author Mestre-Tramador
 */
class DatController extends Controller
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
        $this->middleware('file:dat', [
            'only' => [
                'create',
                'update'
            ]
        ]);
    }

    /**
     * Lists all current stored `.dat` files.
     *
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        return $this->respondWithOK(
            Dat::with('user')
            ->get()
            ->toArray()
        );
    }

    /**
     * Iterate through all the uploaded files in a request,
     * validating and storing all valid `.dat` files.
     *
     * The other files or invalid ones are also
     * specified in the JSON.
     *
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        /**
         * The files sent on the Request.
         *
         * @var array $readFiles
         */
        $readFiles = [];

        /**
         * The local storage instance.
         *
         * @var \Illuminate\Support\Facades\Storage $storage
         */
        $storage = app('storage')::disk('local');

        /**
         * The current response code.
         *
         * @var int $code
         */
        $code = 422;

        /** @var UploadedFile $file */
        foreach (request()->files as $file) {
            /**
             * The current data of the file
             * being read.
             *
             * @var array $readFile
             */
            $readFile = [
                'file' => $file->getClientOriginalName()
            ];

            if (!Dat::validate($file)) {
                $readFile['error'] = 'Incorrect formatted data';

                $readFiles[] = $readFile;

                continue;
            }

            /**
             * A new `.dat` file to store.
             *
             * @var Dat $dat
             */
            $dat = new Dat();

            $dat->user_id = auth()->user()->id;

            /**
             * The current date.
             *
             * @var Carbon $now
             */
            $now = Carbon::now();

            $dat->first_read_at = $now;
            $dat->last_read_at  = $now;

            if (!$dat->save()) {
                $readFile['error'] = 'Could not save file';

                $code = 500;

                $readFiles[] = $readFile;

                continue;
            }

            if (
                !$storage->putFileAs(
                    $this->getDataPath(),
                    $file,
                    $dat->name
                )
            ) {
                $readFile['error'] = 'File was not stored';

                $code = 500;

                $readFiles[] = $readFile;

                $dat->forceDelete();

                continue;
            }

            $readFile['name'] = $dat->name;
            $readFile['data'] = $dat->read();

            $readFiles[] = $readFile;
            $code = 201;
        }

        return $this->respond($readFiles, $code);
    }

    /**
     * Read a stored `.dat` file with the given ID.
     *
     * @param  int $id
     * @return JsonResponse
     */
    public function read(int $id): JsonResponse
    {
        /**
         * The Dat file.
         *
         * @var Dat|null $dat
         */
        $dat = Dat::find($id);

        if (!$dat || $dat->deleted_at) {
            return $this->respondWithNotFound('File');
        }

        return $this->respondWithOK($dat->read());
    }

    /**
     * Update the current `.dat` file referenced by the `$id`.
     *
     * @param  int $id
     * @return JsonResponse
     */
    public function update(int $id): JsonResponse
    {
        /**
         * The Dat file.
         *
         * @var Dat|null $dat
         */
        $dat = Dat::find($id);

        if (!$dat || $dat->deleted_at) {
            return $this->respondWithNotFound('File');
        }

        /**
         * The files on the Request.
         *
         * Only the first one is needed.
         *
         * @var \Symfony\Component\HttpFoundation\FileBag $files
         */
        $files = request()->files;

        /**
         * The new `.dat` file.
         *
         * @var UploadedFile $file
         */
        $file = $files->get(array_key_first($files->all()));

        if (!Dat::validate($file)) {
            return $this->respondWithUnprocessable('Invalid file');
        }

        /**
         * The local storage instance.
         *
         * @var \Illuminate\Support\Facades\Storage $storage
         */
        $storage = app('storage')::disk('local');

        if (
            !$storage->putFileAs(
                $this->getDataPath(),
                $file,
                $dat->name
            )
        ) {
            return $this->respondWithServerError('File was not stored');
        }

        $dat->updated_at = Carbon::now();

        if (!$dat->save()) {
            return $this->respondWithServerError('File was not saved');
        }

        return $this->respondWithOK($dat->toArray() + ['data' => $dat->read()]);
    }

    /**
     * Delete the referenced Dat by the `$id`.
     *
     * Currently it is a *soft* delete, so the database row nor the
     * `.dat` file are really deleted.
     *
     * @param  int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        /**
         * The Dat file.
         *
         * @var Dat|null $dat
         */
        $dat = Dat::find($id);

        if (!$dat || $dat->deleted_at) {
            return $this->respondWithNotFound('File');
        }

        $dat->deleted_at = Carbon::now();

        if (!$dat->delete()) {
            return $this->respondWithServerError('File was not saved');
        }

        return $this->respondWithOK(['deleted' => $dat->name]);
    }
}
