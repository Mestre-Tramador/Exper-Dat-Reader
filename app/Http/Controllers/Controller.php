<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * Generate an Unauthorized response, useful to auth requests.
     *
     * @param string $error
     * @return JsonResponse
     */
    protected function respondWithUnauthorized(string $error = 'Unauthorized'): JsonResponse
    {
        return $this->respondWithError($error, 401);
    }

    /**
     * Generate a response containing an error formatted JSON.
     *
     * @param string|array $error
     * @param integer $code
     * @return JsonResponse
     */
    protected function respondWithError(string|array $error, int $code = 400): JsonResponse
    {
        return response()->json(['error' => $error], $code);
    }
}
