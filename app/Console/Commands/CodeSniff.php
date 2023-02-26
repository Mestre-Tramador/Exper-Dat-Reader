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
 * This command runs PHP Code Sniffer to
 * validate and lint the code.
 *
 *
 * @author Mestre-Tramador
 * @final
 */
final class CodeSniff extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string $signature
     * @ignore Must not be typed.
     */
    protected $signature = 'phpcs';

    /**
     * The console command description.
     *
     * @var string $description
     * @ignore Must not be typed.
     */
    protected $description = 'Runs PHP Code Sniffer.';

    /**
     * Run the App locally.
     *
     * @return int
     */
    public function handle(): int
    {
        /**
         * The shell execution result.
         *
         * @var string|false|null $sh
         */
        $sh = shell_exec('php vendor/bin/phpcs');

        if ($sh) {
            $this->line($sh);

            return self::SUCCESS;
        }

        return self::FAILURE;
    }
}
