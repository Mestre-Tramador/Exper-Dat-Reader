<?php

namespace App\Models\Util;

interface ModelFile
{
    /**
     * Read the contents of the File
     * represented by the Model.
     *
     * @return array
     */
    public function read(): array;
}
