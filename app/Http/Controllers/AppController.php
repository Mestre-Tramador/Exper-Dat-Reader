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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        return $this->respondWithFound('/');
    }

    /**
     * Return the view of the frontend App.
     *
     * @return \Illuminate\View\View
     */
    public function app(): \Illuminate\View\View
    {
        return view('app');
    }
}
