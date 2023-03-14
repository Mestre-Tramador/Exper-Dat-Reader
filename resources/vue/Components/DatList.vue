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
    <ul class="overflow-y-scroll">
        <div
            v-if="!dats"
            class="w-6 h-6 ml-12 rounded-full animate-spin border-y-2 border-dashed border-gray-400 border-t-transparent"
        ></div>

        <card
            v-for="dat in dats"
            :key="dat.id"
            :data="`Inserted at ${dat.first_read.toDateString()}`"
            :title="dat.name"
            bg="bg-transparent"
            class="mx-2 my-1"
        >
            <template #icon>
                <icon
                    :class="{
                        'fill-green-600': dat.isDumped(),
                        'fill-red-600': !dat.isDumped()
                    }"
                />
            </template>
        </card>
    </ul>
</template>

<script lang="ts">
import { defineComponent as component } from "vue";

import Card from "@Components/DashboardCard.vue";

import { Dat } from "@Models/Dat";
import { DocumentIcon as Icon } from "@heroicons/vue/24/solid";

export default component({
    components: {
        Card,
        Icon
    },
    props: {
        /**
         * The list of files to present
         * on the list.
         */
        dats: {
            type: Array<Dat>,
            required: true
        }
    }
});
</script>
