<!--
    Exper-Dat-Reader is a system to read encrypted .dat files and dump their data into .done.dat files.
    Copyright (C) 2023  Mestre-Tramador

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
    <div class="p-1 w-96 h-20 bg-teal-100 rounded-lg shadow-md">
        <div
            class="flex w-full h-full py-2 px-4 bg-white rounded-lg justify-between"
        >
            <div class="my-auto">
                <p class="font-bold">
                    {{ title }}
                </p>

                <div
                    v-if="!data"
                    class="w-6 h-6 ml-12 rounded-full animate-spin border-y-2 border-dashed border-gray-400 border-t-transparent"
                ></div>
                <p v-else class="text-lg">
                    {{ data }}
                </p>
            </div>

            <div class="my-auto">
                <div class="w-12 h-12">
                    <slot name="icon"></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
    props: {
        /**
         * The bold string on the top of the card.
         */
        title: {
            type: String,
            required: true
        },

        /**
         * The data of the card, displayed below.
         *
         * If not present, a spinner is shown.
         */
        data: {
            type: [String, Number, Boolean],
            required: true
        }
    }
});
</script>
