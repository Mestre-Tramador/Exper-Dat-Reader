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

/**
 * Execute tests only related to .dat and
 * .done.dat files.
 *
 * @author Mestre-Tramador
 */
final class DatTest extends TestCase
{
    /**
     * Test the New Dat API Route.
     *
     * The test is asserted when a .dat
     * file is uploaded and saved.
     *
     * @return void
     */
    public function test_dat_upload(): void
    {
        $this->upload(
            $this->userSample(),
            $this->datSample()
        );

        $this->seeStatusCode(201);
    }

    /**
     * Test the Read Dat API Route.
     *
     * The test is asserted when a .dat
     * file is uploaded, saved, and then
     * read.
     *
     * @return void
     */
    public function test_dat_read(): void
    {
        /**
         * The upload HTTP response.
         *
         * @var \Illuminate\Http\Response $upload
         */
        $upload = $this->upload(
            $this->userSample(),
            $this->datSample()
        )->baseResponse;

        if ($json = json_decode($upload->getContent(), true)) {
            /**
             * The ID of the new .dat file register.
             *
             * @var string $id
             */
            $id = str_replace('.dat', '', $json[0]['name']);

            $this->get("api/dat/{$id}")
            ->seeJsonStructure([
                'sellers'   => [],
                'customers' => [],
                'sales'     => []
            ]);
        }
    }

    /**
     * Test the Dump API Route.
     *
     * The test is asserted if the dump is created.
     *
     * @return void
     */
    public function test_done_dat_dump(): void
    {
        $this->dump()->seeStatusCode(201);
    }

    /**
     * Test the Read Dump API Route.
     *
     * The test is asserted if the dump is created,
     * and also read.
     *
     * @return void
     */
    public function test_done_dat_read(): void
    {
        /**
         * The dump HTTP response.
         *
         * @var \Illuminate\Http\Response $dump
         */
        $dump = $this->dump()->response->baseResponse;

        if ($json = json_decode($dump->getContent(), true)) {
            /**
             * The ID of the new .done.dat file register.
             *
             * @var string $id
             */
            $id = str_replace('.done.dat', '', $json['name']);

            $this->get("api/dump/{$id}")
            ->seeJsonStructure([
                'customers_quantity',
                'sellers_quantity',
                'most_expensive_sale_id',
                'worst_seller'
            ]);
        }
    }

    /**
     * A simple helper to upload a .dat file
     * and already dump it.
     *
     * @return $this
     */
    private function dump(): static
    {
        return $this->upload(
            $this->userSample(),
            $this->datSample()
        )->post('api/dump');
    }
}
