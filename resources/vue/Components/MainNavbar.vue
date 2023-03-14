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
    <nav class="absolute w-full px-2 sm:px-4 py-2.5">
        <div class="flex flex-wrap justify-between items-center">
            <div class="items-center ml-auto md:order-2">
                <button
                    id="dropdown"
                    class="flex mr-0 text-sm rounded-full"
                    type="button"
                    :aria-expanded="show"
                    @click="showMenu"
                >
                    <img
                        class="w-9 h-9 rounded-full"
                        src="imgs/user.jpg"
                        alt="User"
                    />
                    <span class="sr-only">Open User menu.</span>
                </button>

                <div
                    id="dropdown-menu"
                    class="absolute right-2 z-10 w-44 bg-white rounded divide-y divide-gray-100 animate-dropdown origin-top-center"
                    :class="{ hidden: !show }"
                >
                    <div class="py-3 px-4 text-sm text-gray-700">
                        <span>
                            {{ user.name }}
                        </span>

                        <br />

                        <span class="font-medium truncate">
                            {{ user.email }}
                        </span>
                    </div>

                    <ul
                        class="py-1 text-sm text-gray-500 hover:text-blue-500"
                        aria-labelledby="dropdown"
                    >
                        <li>
                            <router-link
                                v-for="page in pages"
                                :key="page.label"
                                class="block py-2 px-4"
                                :to="page.route"
                            >
                                {{ page.label }}
                            </router-link>
                        </li>
                    </ul>

                    <div class="py-1">
                        <button
                            class="block py-2 px-4 text-sm text-red-400 hover:text-red-600"
                            @click="logoff"
                        >
                            Sign out
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script lang="ts">
import { defineComponent as component } from "vue";
import { mapGetters as getters, mapMutations as mutations } from "vuex";

import { VueRoute as Route } from "vue-types";

export default component({
    data() {
        return {
            /**
             * Control key for the dropdown menu.
             */
            show: false,

            /**
             * The pages on the dropdown menu.
             */
            get pages(): Route[] {
                return [
                    {
                        route: "/",
                        label: "Menu"
                    }
                ];
            }
        };
    },
    computed: getters(["user"]),
    methods: {
        ...mutations(["setUser", "setToken"]),

        /**
         * Switch between "open" and "close" the dropdown menu.
         */
        showMenu(): void {
            this.show = !this.show;
        },

        /**
         * Logoff, remoking the JWT token and the User state.
         */
        logoff(): void {
            this.setUser(null);
            this.setToken(null);

            this.$router.push({ name: "Login" });
        }
    }
});
</script>
