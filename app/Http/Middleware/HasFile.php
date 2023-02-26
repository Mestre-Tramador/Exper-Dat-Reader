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

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Middleware to validate if (and then the contents)
 * of a sent `.dat` file.
 *
 * @author Mestre-Tramador
 */
class HasFile extends Middleware
{
    /**
     * Verify firstly if any file is uploaded, and then if at least
     * one of these is a `.dat` file.
     *
     * If none files or all the files are of other extensions, a response
     * with the 415 HTTP code is returned.
     *
     * If there is problems with the one of the `.dat` files, a response
     * with the 422 HTTP code is returned otherwise.
     *
     * @param  Request     $request
     * @param  Closure     $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle(
        Request $request,
        Closure $next,
        ?string $guard = null
    ): mixed {
        if (count($request->files) == 0) {
            return $this->respondWithMediaError('You\'ve not uploaded any file!');
        }

        /**
         * Control if any `.dat` file was uploaded.
         *
         * @var bool $hasDat
         */
        $hasDat = false;

        /** @var \Symfony\Component\HttpFoundation\File\UploadedFile $file */
        foreach ($request->files as $file) {
            if (!$hasDat && $file->getClientOriginalExtension() === $guard) {
                $hasDat = true;

                if ($file->getError()) {
                    return $this->respondWithUnprocessable(
                        "File {$file->getClientOriginalName()} have problems on upload."
                    );
                }
            }
        }

        if (!$hasDat) {
            return $this->respondWithMediaError('You\'ve not uploaded any .dat file!');
        }

        return $next($request);
    }
}
