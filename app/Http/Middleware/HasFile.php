<?php

namespace App\Http\Middleware;

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
     */
    public function handle(\Illuminate\Http\Request $request, \Closure $next, ?string $guard = null): mixed
    {
        if(count($request->files) == 0)
        {
            return $this->respondWithMediaError('You\'ve not uploaded any file!');
        }

        /**
         * Control if any `.dat` file was uploaded.
         *
         * @var bool $hasDat
         */
        $hasDat = false;

        /** @var \Symfony\Component\HttpFoundation\File\UploadedFile $file */
        foreach($request->files as $file)
        {
            if(!$hasDat && $file->getClientOriginalExtension() === $guard)
            {
                $hasDat = true;

                if($file->getError())
                {
                    return response()->json(
                        ['error' => "File {$file->getClientOriginalName()} have problems on upload."],
                        422
                    );
                }
            }
        }

        if(!$hasDat)
        {
            return $this->respondWithMediaError('You\'ve not uploaded any .dat file!');
        }

        return $next($request);
    }

    /**
     * Generate a response containing an error
     * formatted JSON around the 415 HTTP code.
     *
     * @param string $error
     * @return \Illuminate\Http\JsonResponse
     */
    private function respondWithMediaError(string $error): \Illuminate\Http\JsonResponse
    {
        return response()->json(['error' => $error], 415);
    }
}
