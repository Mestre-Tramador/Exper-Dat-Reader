<?php

namespace App\Http\Controllers;

use App\Models\Dat;

use Carbon\Carbon;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class DatController extends Controller
{
    /**
     * The storage path to `.dat` files.
     *
     * @var string
     */
    private const PATH_IN = 'data/in';

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
                'store',
                'update'
            ]
        ]);
    }

    /**
     * Lists all current stored `.dat` files.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function list()
    {
        return response()->json(Dat::with('user')->get());
    }

    /**
     * Read a stored `.dat` file with the given ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function read($id)
    {
        /**
         * The Dat file.
         *
         * @var Dat|null $dat
         */
        $dat = Dat::find($id);

        if(!$dat || $dat->deleted_at)
        {
            return response()->json(['error' => 'File not found'], 404);
        }

        return response()->json($dat->read());
    }

    /**
     * Iterate through all the uploaded files in a request,
     * validating and storing all valid `.dat` files.
     *
     * The other files or invalid ones are also
     * specified in the JSON.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
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
        foreach(request()->files as $file)
        {
            /**
             * The current data of the file
             * being read.
             *
             * @var array $readFile
             */
            $readFile = [
                'file' => $file->getClientOriginalName()
            ];

            if(!Dat::validate($file))
            {
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

            $now = Carbon::now();

            $dat->first_read_at = $now;
            $dat->last_read_at  = $now;

            if(!$dat->save())
            {
                $readFile['error'] = 'Could not save file';

                $code = 500;

                $readFiles[] = $readFile;

                continue;
            }

            if(!$storage->putFileAs(self::PATH_IN, $file, $dat->name))
            {
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

        return response()->json($readFiles, $code);
    }

    /**
     * Update the current `.dat` file referenced by the `$id`.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id)
    {
        /**
         * The Dat file.
         *
         * @var Dat|null $dat
         */
        $dat = Dat::find($id);

        if(!$dat || $dat->deleted_at)
        {
            return response()->json(['error' => 'File not found'], 404);
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

        if(!Dat::validate($file))
        {
            return response()->json(['error' => 'Invalid file'], 422);
        }

        /**
         * The local storage instance.
         *
         * @var \Illuminate\Support\Facades\Storage $storage
         */
        $storage = app('storage')::disk('local');

        if(!$storage->putFileAs(self::PATH_IN, $file, $dat->name))
        {
            return response()->json(['error' => 'File was not stored'], 500);
        }

        $dat->updated_at = Carbon::now();

        if(!$dat->save())
        {
            return response()->json(['error' => 'File was not saved'], 500);
        }

        return response()->json($dat->toArray() + ['data' => $dat->read()]);
    }

    /**
     * Delete the referenced Dat by the `$id`.
     *
     * Currently it is a *soft* delete, so the database row nor the
     * `.dat` file are really deleted.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        /**
         * The Dat file.
         *
         * @var Dat|null $dat
         */
        $dat = Dat::find($id);

        if(!$dat || $dat->deleted_at)
        {
            return response()->json(['error' => 'File not found'], 404);
        }

        $dat->deleted_at = Carbon::now();

        if(!$dat->save())
        {
            return response()->json(['error' => 'File was not saved'], 500);
        }

        return response()->json(['deleted' => $dat->name]);
    }
}
