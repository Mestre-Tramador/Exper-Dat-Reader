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

namespace Tests;

use App\Models\Dat;
use App\Models\DoneDat;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Testing\TestResponse;
use Laravel\Lumen\Application;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Laravel\Lumen\Testing\TestCase as BaseTestCase;

/**
 * Base test case, with helpers
 * to use on other tests.
 *
 * @author Mestre-Tramador
 */
abstract class TestCase extends BaseTestCase
{
    use DatabaseTransactions;

    #region Setup
    /**
     * Creates the application.
     *
     * @return Application
     */
    final public function createApplication(): Application
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    /**
     * Add one more callback before the application
     * is destroyed after all the `parent` method
     * was executed.
     *
     * @return void
     */
    final protected function setUp(): void
    {
        parent::setUp();

        $this->beforeApplicationDestroyed(function (): void {
            /**
             * All .dat files, including the deleted ones.
             *
             * @var \Illuminate\Database\Eloquent\Collection<Dat> $dats
             */
            $dats = Dat::withTrashed()->get();

            /**
             * All .done.dat files, including the deleted ones.
             *
             * @var \Illuminate\Database\Eloquent\Collection<DoneDat> $dumps
             */
            $dumps = DoneDat::withTrashed()->get();

            /**
             * The local storage instance.
             *
             * @var \Illuminate\Support\Facades\Storage $storage
             */
            $storage = app('storage')::disk('local');

            if ($dats->count() === 0 && $dumps->count() === 0) {
                /** @var array $dats */
                $dats = $storage->allFiles(Dat::getDataPath());

                /** @var array $dats */
                $dumps = $storage->allFiles(DoneDat::getDataPath());

                /** @var array $files */
                foreach ([$dats, $dumps] as $files) {
                    /** @var string $file */
                    foreach ($files as $file) {
                        $storage->delete($file);
                    }
                }

                return;
            }

            foreach ([$dats, $dumps] as $files) {
                /** @var Dat|DoneDat $file */
                foreach ($files as $file) {
                    $storage->delete($file->path);
                }
            }
        });
    }
    #endregion

    #region Samples
    /**
     * Get a sample of a Dat for upload.
     *
     * @return UploadedFile
     */
    final protected function datSample(): UploadedFile
    {
        /**
         * The path for the test file (sample).
         *
         * @var string $testFile
         */
        $testFile = env('TEST_FILE', '');

        if ($testFile) {
            return new UploadedFile(
                $testFile,
                last(explode('/', $testFile)),
                'text/plain'
            );
        }

        return new UploadedFile(
            $testFile,
            '.dat',
            'text/plain',
            UPLOAD_ERR_NO_FILE
        );
    }

    /**
     * Create a fake User for temporary use.
     *
     * @return User
     */
    final protected function userSample(): User
    {
        return User::factory()->makeOne();
    }
    #endregion

    #region Helpers
    /**
     * Register and start acting as the new created User.
     *
     * @param  User $user
     * @return $this
     */
    final protected function asRegisteredUser(User $user): static
    {
        return $this->register($user)->actingAs($user);
    }

    /**
     * Call for the Register API Route and create the given User.
     *
     * @param  User $user
     * @return $this
     */
    final protected function register(User $user): static
    {
        return $this->post(
            '/api/register',
            [
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password
            ]
        );
    }

    /**
     * Upload a single .dat file as the registered given User.
     *
     * @param  User         $user
     * @param  UploadedFile $dat
     * @return TestResponse
     */
    final protected function upload(User $user, UploadedFile $dat): TestResponse
    {
        return $this->asRegisteredUser($user)->call('POST', 'api/dat', [], [], [$dat]);
    }
    #endregion
}
