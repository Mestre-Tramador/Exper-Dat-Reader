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

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Make the App's Key if it's unset
 * or incorrectly formatted.
 *
 * @author Mestre-Tramador
 * @final
 */
final class MakeKey extends Command
{
    /**
     * The `.env` key which this command handles.
     *
     * @var string
     */
    private const APP_KEY = 'APP_KEY';

    /**
     * The name and signature of the console command.
     *
     * @var string $signature
     * @ignore Must not be typed.
     */
    protected $signature = 'make:key';

    /**
     * The console command description.
     *
     * @var string $description
     * @ignore Must not be typed.
     */
    protected $description = 'Make your ENV Key.';

    /**
     * Check if the App's key is set, and if
     * not try to set it on the current `.env` file.
     *
     * @return int
     */
    public function handle(): int
    {
        /**
         * The App's Key.
         *
         * @var string $app_key
         */
        $app_key = env(self::APP_KEY);

        if (strlen($app_key) === 32) {
            return $this->OK();
        }

        /**
         * The `.env` base path.
         *
         * @var string $env
         */
        $env = base_path('.env');

        if (file_exists($env)) {
            /**
             * The environment KEY.
             *
             * @var string $key
             */
            $key = self::APP_KEY.'=';

            /**
             * The replaced `.env` content.
             *
             * @var string $replaced_env
             */
            $replaced_env = str_replace(
                $key.$app_key,
                $key.md5(env('APP_NAME')),
                file_get_contents($env)
            );

            if (file_put_contents($env, $replaced_env)) {
                $this->info('Everything OK!');

                return self::SUCCESS;
            }

            $this->error('Something gone wrong!');

            return self::FAILURE;
        }
    }
}
