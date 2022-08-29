<?php

namespace App\Models\Util;

use App\Models\Dat;

trait IsFile
{
    /**
     * Assemble a full name of the following file, basically
     * concatenating both params with a dot.
     *
     * If the given `$name` is null or empty, then a blank
     * `string` is returned.
     *
     * @param string|null $name
     * @param string $ext
     * @return string
     */
    protected function getFileName(?string $name, string $ext): string
    {
        if(!$name)
        {
            return '';
        }

        return "{$name}.{$ext}";
    }

    /**
     * According to the `class` which is using the
     * `trait`, a path in the storage is returned.
     *
     * @return string
     */
    protected function getDataPath(): string
    {
        switch($this::class)
        {
            case Dat::class: return 'data/in';
            default:         return 'data';
        }
    }
}
