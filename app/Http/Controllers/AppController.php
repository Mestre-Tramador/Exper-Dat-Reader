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

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Controller to handle the frontend App.
 *
 * @author Mestre-Tramador
 */
class AppController extends Controller
{
    /**
     * Basically return to the index of the App.
     *
     * @return RedirectResponse
     */
    public function index(): RedirectResponse
    {
        /**
         * The base path for the app.
         *
         * @var string $path
         */
        $path = '/';

        /**
         * A possible path on the request.
         *
         * @var string $reqPath
         */
        if ($reqPath = request()->path()) {
            $path .= "?p={$reqPath}";
        }

        return $this->respondWithFound($path);
    }

    /**
     * Return the view of the frontend App.
     *
     * @return View
     */
    public function app(): View
    {
        return view('app')->with('Y', date('Y'));
    }
}
