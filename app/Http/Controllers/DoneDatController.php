<?php

namespace App\Http\Controllers;

use App\Models\{Dat, DoneDat};

use Carbon\Carbon;

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
        return response()->json(DoneDat::get());
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
            return response()->json(['error' => 'File not found'], 404);
        }

        return response()->json($doneDat->read());
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
    public function dump()
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
            return response()->json(['message' => 'No newer Dat files'], 202);
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
        $dump = DoneDat::make($dats);

        /**
         * A new `.done.dat` file to store.
         *
         * @var DoneDat $doneDat
         */
        $doneDat = new DoneDat();

        if(!$doneDat->save())
        {
            return response()->json(['error' => 'Could not save file'], 500);
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

            return response()->json(['error' => 'File was not stored'], 500);
        }

        return response()->json(
            [
                'name' => $doneDat->name,
                'data' => $doneDat->read()
            ],
            201
        );
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
            return response()->json(['error' => 'File not found'], 404);
        }

        $doneDat->deleted_at = Carbon::now();

        if(!$doneDat->save())
        {
            return response()->json(['error' => 'File was not saved'], 500);
        }

        return response()->json(['deleted' => $doneDat->name]);
    }
}
