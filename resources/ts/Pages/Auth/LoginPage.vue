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
    <main-layout>
        <div class="max-w-2xl">
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
                <form class="w-1/3 px-6 pt-6 m-auto" @submit.prevent="login">
                    <login-input
                        id="email"
                        v-model="form.email"
                        type="text"
                        label="Email"
                        :bottom="4"
                        :errors="form.errors.email"
                    ></login-input>

                    <login-input
                        id="password"
                        v-model="form.password"
                        type="password"
                        label="Password"
                        :bottom="4"
                        :errors="form.errors.password"
                    ></login-input>

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
    </main-layout>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { mapGetters, mapMutations } from "vuex";
import { AxiosError, AxiosResponse } from "axios";

import LoginInput from "@Components/Auth/LoginInput.vue";
import MainLayout from "@Components/Layout/MainLayout.vue";

import { AuthForm } from "@Models/AuthForm";
import { AuthFormErrors } from "@Interfaces/AuthFormErrors";
import { LoginData } from "@Interfaces/LoginData";

export default defineComponent({
    components: {
        MainLayout,
        LoginInput
    },
    data() {
        return {
            /**
             * Handle the current form.
             */
            form: AuthForm.create()
        };
    },
    computed: mapGetters(["isLoggedIn"]),
    created() {
        if (this.isLoggedIn) {
            this.$router.push({ name: "Menu" });
        }
    },
    methods: {
        ...mapMutations(["setUser", "setToken"]),

        /**
         * Execute the login and redirect to the Menu if
         * successful, otherwise present the errors.
         *
         * @param event Theve default submit event.
         */
        login(event: Event): void {
            event.preventDefault();

            this.form.clearErrors();

            this.$http
                .post("api/login", {
                    email: this.form.email,
                    password: this.form.password
                })
                .then((res: AxiosResponse<LoginData>) => {
                    this.setUser(res.data.user);
                    this.setToken(res.data.access_token);

                    this.$router.push({ name: "Menu" });
                })
                .catch((err: AxiosError<AuthFormErrors>) => {
                    const data = err.response?.data;

                    this.form.errors.email = data?.email ?? [];
                    this.form.errors.password = data?.password ?? [];
                    this.form.errors.message = (data?.error as string) ?? "";
                });
        }
    }
});
</script>
