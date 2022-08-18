<?php

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
     */
    protected $signature = 'make:key';

    /**
     * The console command description.
     *
     * @var string $description
     */
    protected $description = 'Make your ENV Key.';

    /**
     * Check if the App's key is set, and if
     * not try to set it on the current `.env` file.
     *
     * @return int
     */
    public function handle()
    {
        /**
         * The App's Key.
         *
         * @var string $app_key
         */
        $app_key = env(self::APP_KEY);

        if(strlen($app_key) === 32)
        {
            return $this->OK();
        }

        /**
         * The `.env` base path.
         *
         * @var string $env
         */
        $env = base_path('.env');

        if(file_exists($env))
        {
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
            $replaced_env = str_replace($key.$app_key, $key.md5(env('APP_NAME')), file_get_contents($env));

            if(file_put_contents($env, $replaced_env))
            {
                $this->info('Everything OK!');

                return self::SUCCESS;
            }

            $this->error('Something gone wrong!');

            return self::FAILURE;
        }
    }
}
