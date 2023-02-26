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
use Notihnio\MultipartFormDataParser\MultipartFormDataParser;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Middleware to parse a `multipart/form-data` sent on
 * a `PUT`, which may contain a `.dat` file.
 *
 * @author Mestre-Tramador
 */
class ParsePUT extends Middleware
{
    /**
     * Parse a FormData correctly on the `PUT` and `PATCH`s requests.
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
        if (
            $request->method() !== 'PUT' &&
            $request->method() !== 'PATCH'
        ) {
            return $next($request);
        }

        if (
            preg_match(
                '/multipart\/form-data/',
                $request->headers->get('Content-Type')
            )
        ) {
            /**
             * The parsed form-data.
             *
             * @var \Notihnio\MultipartFormDataParser\MultipartFormDataset|null $formData
             */
            $formData = MultipartFormDataParser::parse($request);

            if (!$formData) {
                return $this->respondWithClientError('Your data is invalid!');
            }

            /**
             * @var string $name
             * @var array $file
             */
            foreach ($formData->files as $name => $file) {
                $formData->files[$name] = new UploadedFile(
                    $file['tmp_name'],
                    $file['name'],
                    $file['type'],
                    $file['error']
                );
            }

            $request->request->add($formData->params);
            $request->files->add($formData->files);
        }

        return $next($request);
    }
}
