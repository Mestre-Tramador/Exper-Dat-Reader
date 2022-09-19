<!--
    Exper-Dat-Reader is a system to read encrypted .dat files and dump their data into .done.dat files.
    Copyright (C) 2022  Mestre-Tramador

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <https://www.gnu.org/licenses/>.
-->

<template>
    <section class="bg-white border-b py-8 m-auto rounded">
        <div class="container max-w-5xl mx-auto mt-8">
            <img
                src="imgs/logo.png"
                alt="Exper-Dat-Reader"
                class="w-1/2 my-2 mx-auto"
            />

            <div class="w-full mb-4">
                <div
                    class="h-1 mx-auto gradient w-1/2 opacity-25 my-0 py-0 rounded"
                ></div>
            </div>

            <div class="flex flex-wrap">
                <div class="w-1/2 px-6 pt-6 m-auto text-center">
                    <h3
                        class="text-3xl text-gray-800 font-bold leading-none mb-3"
                    >
                        Site under construction!
                    </h3>
                    <p class="text-gray-600 mb-8">
                        Currently our website is under construction.

                        <br />

                        Please follow our

                        <a :href="href" target="_blank" class="text-blue-600">
                            GitHub
                        </a>

                        page to see the progress.
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
    data() {
        return {
            href: "https://github.com/Mestre-Tramador/Exper-Dat-Reader"
        };
    }
});
</script>
