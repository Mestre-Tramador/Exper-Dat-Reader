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
    <main-layout>
        <div class="flex">
            <div class="text-blue-500 h-12 w-12 mb-1">
                <slot name="icon"></slot>
            </div>

            <div class="mx-2 my-auto text-lg text-blue-400 cursor-default">
                {{ title }}
            </div>
        </div>

        <hr />

        <div class="text-gray-500">
            <slot name="page"></slot>
        </div>
    </main-layout>
</template>

<script lang="ts">
import { defineComponent } from "vue";

import MainLayout from "./MainLayout.vue";

export default defineComponent({
    components: {
        MainLayout
    },
    props: {
        /**
         * The Title of the page.
         */
        title: {
            type: String,
            default: ""
        }
    }
});
</script>
