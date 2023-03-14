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

namespace App\Http\Util;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

/**
 * Create easily response methods with the most used HTTP codes.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Status
 * @author Mestre-Tramador
 */
trait CanRespond
{
    /**
     * Respond the given `$resource` as a JSON as everything
     * ocurred well.
     *
     * * Code: **200**
     * * Status: **OK**
     *
     * @param  array $resource
     * @return JsonResponse
     * @final
     */
    final protected function respondWithOK(array $resource): JsonResponse
    {
        return $this->respond($resource, 200);
    }

    /**
     * Respond the given `$resource` as a JSON as it was created.
     *
     * * Code: **201**
     * * Status: **Created**
     *
     * @param  array $resource
     * @return JsonResponse
     * @final
     */
    final protected function respondWithCreated(array $resource): JsonResponse
    {
        return $this->respond($resource, 201);
    }

    /**
     * Respond the given `$message` as a JSON Message, but none
     * action was taken.
     *
     * * Code: **202**
     * * Status: **Accepted**
     *
     * @param  string $message
     * @return JsonResponse
     * @final
     */
    final protected function respondWithAccepted(string $message): JsonResponse
    {
        return $this->respondWithMessage($message, 202);
    }

    /**
     * Respond without a JSON Message, but maybe with some headers.
     *
     * * Code: **204**
     * * Status: **No Content**
     *
     * @param  string $message
     * @return JsonResponse
     * @final
     */
    final protected function respondWithNoContent(): JsonResponse
    {
        return $this->respond([], 204);
    }

    /**
     * Respond and redirect to the new `$route`.
     *
     * * Code: **302**
     * * Status: **Found**
     *
     * @param  string $route
     * @return RedirectResponse
     * @final
     */
    final protected function respondWithFound(string $route): RedirectResponse
    {
        return redirect($route, 302);
    }

    /**
     * Respond the given `$error` as a JSON Error, explaining the
     * motives or giving more info as a resource.
     *
     * * Code: **400**
     * * Status: **Bad Request**
     *
     * @param  string|array $error
     * @return JsonResponse
     * @final
     */
    final protected function respondWithClientError(string|array $error): JsonResponse
    {
        return $this->respondWithError($error, 400);
    }

    /**
     * Respond the given `$error` as a JSON Error, but because
     * there was a problem with authentication.
     *
     * * Code: **401**
     * * Status: **Unauthorized**
     *
     * @param  string $error
     * @return JsonResponse
     * @final
     */
    final protected function respondWithUnauthorized(string $error = 'Unauthorized'): JsonResponse
    {
        return $this->respondWithError($error, 401);
    }

    /**
     * Respond that the given `$resource` was not found, as a JSON Error.
     *
     * * Code: **404**
     * * Status: **Not Found**
     *
     * @param  string $resource
     * @return JsonResponse
     * @final
     */
    final protected function respondWithNotFound(string $resource = 'Resource'): JsonResponse
    {
        return $this->respondWithError("{$resource} not found", 404);
    }

    /**
     * Respond the given `$error` as a JSON Error about the media (files)
     * on the request.
     *
     * * Code: **415**
     * * Status: **Unsupported Media Type**
     *
     * @param  string $error
     * @return JsonResponse
     * @final
     */
    final protected function respondWithMediaError(string $error): JsonResponse
    {
        return  $this->respondWithError($error, 415);
    }

    /**
     * Respond the given `$error` as a JSON Error about the data (body)
     * of the request.
     *
     * * Code: **422**
     * * Status: **Unprocessable Entity**
     *
     * @param  string $error
     * @return JsonResponse
     * @final
     */
    final protected function respondWithUnprocessable(string $error): JsonResponse
    {
        return  $this->respondWithError($error, 422);
    }

    /**
     * Respond the given `$error` as a JSON Error, implying the code error
     * either as message or resource.
     *
     * * Code: **500**
     * * Status: **Internal Server Error**
     *
     * @param  string|array $error
     * @return JsonResponse
     * @final
     */
    final protected function respondWithServerError(string|array $error): JsonResponse
    {
        return $this->respondWithError($error, 500);
    }

    /**
     * Create a response as a JSON Message with the given code.
     *
     * A JSON Message looks like:
     * ```php
     * ['message' => $message]
     * ```
     *
     * @param  string|array $message
     * @param  int          $code
     * @return JsonResponse
     * @final
     */
    final protected function respondWithMessage(string|array $message, int $code): JsonResponse
    {
        return $this->respond(compact('message'), $code);
    }

    /**
     * Create a response as a JSON Error with the given code.
     *
     * A JSON Error looks like:
     * ```php
     * ['error' => $error]
     * ```
     *
     * @param  string|array $error
     * @param  int          $code
     * @return JsonResponse
     * @final
     */
    final protected function respondWithError(string|array $error, int $code): JsonResponse
    {
        return $this->respond(compact('error'), $code);
    }

    /**
     * Create a response with the given array as its JSON and the code.
     *
     * @param  array $response
     * @param  int   $code
     * @return JsonResponse
     * @final
     */
    final protected function respond(array $response, int $code): JsonResponse
    {
        return response()->json($response, $code);
    }
}
