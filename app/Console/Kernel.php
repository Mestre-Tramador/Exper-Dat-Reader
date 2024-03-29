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

namespace App\Console;

use App\Console\Commands\CodeSniff;
use App\Console\Commands\MakeKey;
use App\Console\Commands\Serve;
use App\Console\Commands\Test;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

/**
 * Artisan Commands Kernel.
 *
 * @author Mestre-Tramador
 */
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     * @ignore Must not be typed.
     */
    protected $commands = [
        CodeSniff::class,
        MakeKey::class,
        Serve::class,
        Test::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        //
    }
}
