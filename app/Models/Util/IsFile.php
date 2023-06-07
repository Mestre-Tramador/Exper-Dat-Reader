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

use Exception;
use LogicException;
use ReflectionClassConstant;
use ReflectionException;

/**
 * Make a Model act like a stored file.
 *
 * @author Mestre-Tramador
 */
trait IsFile
{
    use FilePaths;

    /**
     * Additionally has two new attributes for the files:
     * * **name:** Return a string on the format `id.ext`;
     * * **path:** The data path of the file, including its name;
     * * **file:** Get the contents of the stored file, or return `null`.
     *
     * For other `$key`s, it calls its parents implementations.
     *
     * @param  string $key
     * @return mixed
     */
    public function __get($key)
    {
        switch ($key) {
            case 'name':
                return $this->callIfExtConstIsDefined(
                    fn(): string => $this->getFileName($this->id, $this::class::EXT)
                );
            case 'path':
                return "{$this->getDataPath()}/{$this->name}";
            case 'file':
                return app('storage')::disk('local')->get($this->path);
            default:
                return parent::__get($key);
        }
    }

    /**
     * Assemble a full name of the following file, basically
     * concatenating both params with a dot.
     *
     * If the given `$name` is null or empty, then a blank
     * `string` is returned.
     *
     * @param  string|null $name
     * @param  string      $ext
     * @return string
     */
    protected function getFileName(?string $name, string $ext): string
    {
        if (!$name) {
            return '';
        }

        return "{$name}.{$ext}";
    }

    /**
     * An internal function to control if the `class`
     * which use the `trait` have a constant named
     * "*EXT*".
     *
     * If the `class` have the constant, then the `$fn`
     * call is returned.
     *
     * @param  callable $fn
     * @return mixed
     *
     * @throws LogicException
     */
    private function callIfExtConstIsDefined(callable $fn): mixed
    {
        try {
            /**
             * The `class` name.
             *
             * @var string $class
             */
            $class = $this::class;

            /**
             * A reflection to know if the constant is implemented.
             *
             * @var ReflectionClassConstant $constant
             */
            $constant = new ReflectionClassConstant($class, 'EXT');

            /**
             * The value of the constant.
             *
             * @var bool|int|float|string|array $value
             */
            $value = $constant->getValue();

            if ($value && is_string($value)) {
                return $fn();
            }

            throw new Exception("Class {$class} has a non-string value for the constant EXT");
        } catch (ReflectionException $r) {
            throw new LogicException("Class {$class} does not implements constant EXT");
        } catch (Exception $e) {
            throw new LogicException($e->getMessage());
        }
    }
}
