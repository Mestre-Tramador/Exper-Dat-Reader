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
    <head-page-layout title="New Dat">
        <template #icon>
            <document-plus-icon />
        </template>

        <template #page>
            <form class="text-center" @submit.prevent="upload">
                <div class="p-2">
                    <new-dat-file-input
                        id="dats"
                        v-model="form.dats"
                        :error="form.errors.message"
                    />
                </div>

                <button
                    class="bg-blue-400 hover:bg-blue-500 text-white font-bold m-auto py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit"
                >
                    Send
                </button>
            </form>
        </template>
    </head-page-layout>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { mapGetters } from "vuex";
import { AxiosError } from "axios";

import HeadPageLayout from "@Components/Layout/HeadPageLayout.vue";
import NewDatFileInput from "@Components/Formulary/NewDatFileInput.vue";

import { DocumentPlusIcon } from "@heroicons/vue/24/solid";
import { NewDatForm } from "@Models/NewDatForm";
import { NewDatFormErrors } from "@Interfaces/NewDatFormErrors";

export default defineComponent({
    components: {
        HeadPageLayout,
        NewDatFileInput,
        DocumentPlusIcon
    },
    data() {
        return {
            /**
             * Handle the current form.
             */
            form: NewDatForm.create()
        };
    },
    computed: mapGetters(["token"]),
    methods: {
        /**
         * Uploads all the files to the API.
         *
         * In case of success, there is a redirection
         * to the Menu, else an error is displayed.
         */
        upload(): void {
            this.form.clearErrors();

            this.$http
                .post("api/dat", this.form.dats, {
                    headers: {
                        Authorization: `Bearer ${this.token}`,
                        "Content-Type": "multipart/form-data"
                    }
                })
                .then(() => window.location.replace("/"))
                .catch((err: AxiosError<NewDatFormErrors>) => {
                    const data = err.response?.data;

                    this.form.errors.dats = data?.dats ?? [];
                    this.form.errors.message = (data?.error as string) ?? "";
                });
        }
    }
});
</script>
