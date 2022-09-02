<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

use Notihnio\MultipartFormDataParser\MultipartFormDataParser;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class ParsePUT extends Middleware
{
    /**
     * Parse a FormData correctly on the `PUT` and `PATCH`s requests.
     *
     * @param Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle(Request $request, \Closure $next, ?string $guard = null): mixed
    {
        if($request->method() !== 'PUT' && $request->method() !== 'PATCH')
        {
            return $next($request);
        }

        if(preg_match('/multipart\/form-data/', $request->headers->get('Content-Type')))
        {
            /**
             * The parsed form-data.
             *
             * @var \Notihnio\MultipartFormDataParser\MultipartFormDataset|null $formData
             */
            $formData = MultipartFormDataParser::parse($request);

            if(!$formData)
            {
                return response()->json(['error' => 'Your data is invalid!'], 415);
            }

            /**
             * @var string $name
             * @var array $file
             */
            foreach($formData->files as $name => $file)
            {
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
