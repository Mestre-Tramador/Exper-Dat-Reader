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
    <layout>
        <div class="flex">
            <img
                src="imgs/logo.png"
                alt="Exper-Dat-Reader"
                class="w-96 my-2 mx-auto"
            />
        </div>

        <hr />

        <div class="flex mt-4">
            <!-- Start of "Dashboard" button. -->
            <router-link
                class="text-blue-500 hover:text-teal-600 m-auto"
                :to="{ name: 'Dashboard' }"
            >
                <dashboard-icon class="h-32 w-32" />
            </router-link>
            <!-- End of "Dashboard" button. -->

            <!-- Start of "Add File" button. -->
            <router-link
                class="text-blue-500 hover:text-emerald-500 m-auto"
                :to="{ name: 'New Dat' }"
            >
                <new-dat-icon class="h-32 w-32" />
            </router-link>
            <!-- End of "Add File" button. -->

            <!-- Start of "File List" button. -->
            <router-link
                class="text-blue-500 hover:text-blue-700 m-auto"
                :to="{ name: 'Listage' }"
            >
                <listage-icon class="h-32 w-32" />
            </router-link>
            <!-- End of "File List" button. -->

            <!-- Future "Dump Files" button. -->
            <router-link
                class="text-blue-500 hover:text-cyan-800 m-auto"
                to="/"
            >
                <dump-icon class="h-32 w-32" />
            </router-link>
        </div>
    </layout>
</template>

<script lang="ts">
import { defineComponent as component } from "vue";

import Layout from "@Components/MainLayout.vue";

import {
    DocumentChartBarIcon as DashboardIcon,
    DocumentCheckIcon as DumpIcon,
    DocumentPlusIcon as NewDatIcon,
    DocumentTextIcon as ListageIcon
} from "@heroicons/vue/24/solid";

export default component({
    components: {
        Layout,
        DashboardIcon,
        DumpIcon,
        ListageIcon,
        NewDatIcon
    },
    created() {
        if (this.$route.query.p) {
            this.$router.push(`/${this.$route.query.p}`);

            return;
        }
    }
});
</script>
