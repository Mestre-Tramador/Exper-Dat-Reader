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
        <div class="max-w-2xl">
            <img src="imgs/logo.png" alt="Exper-Dat-Reader" class="w-1/2 my-2 mx-auto" />

            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-1/2 opacity-25 my-0 py-0 rounded"></div>
            </div>

            <div class="flex flex-wrap">
                <form class="w-1/3 px-6 pt-6 m-auto" @submit.prevent="login">
                    <control
                        id="email"
                        v-model="form.email"
                        type="text"
                        label="Email"
                        :bottom="4"
                        :errors="form.errors.email"
                    />

                    <control
                        id="password"
                        v-model="form.password"
                        type="password"
                        label="Password"
                        :bottom="4"
                        :errors="form.errors.password"
                    />

                    <p class="text-red-500 text-center text-xs italic mb-4">
                        {{ form.errors.message }}
                    </p>

                    <div class="flex items-center justify-between">
                        <button
                            class="bg-blue-400 hover:bg-blue-500 text-white font-bold m-auto py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit"
                        >
                            Sign In
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </layout>
</template>

<script lang="ts">
import { defineComponent as component } from "vue";
import { mapMutations as mutations } from "vuex";
import { AxiosError as Error, AxiosResponse as Response } from "axios";

import Control from "@Components/LoginInput.vue";
import Layout from "@Components/MainLayout.vue";

import { AuthForm as Form } from "@Models/AuthForm";
import { AuthFormErrors as Errors } from "@Interfaces/AuthFormErrors";
import { LoginData as Data } from "@Interfaces/LoginData";

export default component({
    components: {
        Layout,
        Control
    },
    data() {
        return {
            /**
             * Handle the current form.
             */
            form: Form.create()
        };
    },
    methods: {
        ...mutations(["setUser", "setToken"]),

        /**
         * Execute the login and redirect to the Menu if
         * successful, otherwise present the errors.
         */
        login(): void {
            this.form.clearErrors();

            this.$http
                .post("api/login", {
                    email: this.form.email,
                    password: this.form.password
                })
                .then((res: Response<Data>) => {
                    this.setUser(res.data.user);
                    this.setToken(res.data.access_token);

                    this.$router.push({ name: "Index" });
                })
                .catch((err: Error<Errors>) => {
                    const data = err.response?.data;

                    this.form.errors.email = data?.email ?? [];
                    this.form.errors.password = data?.password ?? [];
                    this.form.errors.message = (data?.error as string) ?? "";
                });
        }
    }
});
</script>
