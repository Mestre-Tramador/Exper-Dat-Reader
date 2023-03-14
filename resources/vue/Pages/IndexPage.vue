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
    <layout class="main-layout-preserve">
        <div class="flex">
            <img
                src="imgs/logo.png"
                alt="Exper-Dat-Reader"
                class="w-96 my-2 mx-auto"
            />
        </div>

        <hr />

        <div v-if="error" class="mt-4 text-6xl text-center text-red-500">
            {{ error }}

            <br />

            <span class="text-4xl">Recarregando a página...</span>
        </div>
        <div
            v-else-if="dumping"
            class="w-20 h-20 mx-48 my-8 rounded-full animate-spin border-y-2 border-dashed border-gray-400 border-t-transparent"
        ></div>
        <div v-else class="flex mt-4">
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

            <!-- Start of "Dump Files" button. -->
            <button
                class="text-blue-500 hover:text-cyan-800 m-auto"
                @click="dump"
            >
                <dump-icon class="h-32 w-32" />
            </button>
            <!-- End of "Dump Files" button. -->
        </div>
    </layout>
</template>

<script lang="ts">
import { defineComponent as component } from "vue";
import { mapGetters as getters } from "vuex";
import { AxiosError as Error } from "axios";

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
    data() {
        return {
            dumping: false,
            error: null
        } as { dumping: boolean; error: string | null };
    },
    computed: getters(["token"]),
    created() {
        if (this.$route.query.p) {
            this.$router.push(`/${this.$route.query.p}`);

            return;
        }
    },
    methods: {
        /**
         * Call on the API to dump all the Dat files,
         * then show the results directly on the Dashboard.
         */
        dump(): void {
            this.dumping = true;

            this.$http
                .post("/api/dump", null, {
                    headers: {
                        Authorization: `Bearer ${this.token}`
                    }
                })
                .then(() => this.$router.push({ name: "Dashboard" }))
                .catch((err: Error) => {
                    this.dumping = false;

                    this.error =
                        (err.response?.data as string) ??
                        "Erro não identificado";

                    setTimeout(window.location.reload, 1.5e3);
                });
        }
    }
});
</script>
