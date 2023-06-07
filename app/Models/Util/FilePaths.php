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

namespace App\Models\Util;

use App\Http\Controllers\DatController;
use App\Http\Controllers\DoneDatController;
use App\Models\Dat;
use App\Models\DoneDat;

/**
 * Use storage paths according to the type of file.
 *
 * @author Mestre-Tramador
 */
trait FilePaths
{
    /**
     * Allow the method **getDataPath** to be called
     * statically, but it still considers the class name.
     *
     * For other methods, the parent implementation is called.
     *
     * @param  string $name
     * @param  array  $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        if ($name === 'getDataPath') {
            return (new self())->getDataPath();
        }

        return parent::__callStatic($name, $arguments);
    }

    /**
     * According to the `class` which is using the
     * `trait`, a path in the storage is returned.
     *
     * The presence of a test folder on the env
     * is considered.
     *
     * @return string
     */
    protected function getDataPath(): string
    {
        /**
         * The folder to save the test files
         * in the storage.
         *
         * @var string $testFolder
         */
        $testFolder = env('TEST_FOLDER');

        if (is_string($testFolder) && !str_ends_with($testFolder, '/')) {
            $testFolder .= '/';
        }

        switch ($this::class) {
            case Dat::class:
            case DatController::class:
                return "{$testFolder}data/in";
            case DoneDat::class:
            case DoneDatController::class:
                return "{$testFolder}data/out";
            default:
                return "{$testFolder}data";
        }
    }
}
