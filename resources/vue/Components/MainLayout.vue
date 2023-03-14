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
    <section>
        <navbar v-if="isLoggedIn"></navbar>

        <div class="flex h-screen w-screen">
            <div class="bg-white border-b py-4 m-auto rounded">
                <div class="container mx-auto">
                    <slot></slot>
                </div>
            </div>
        </div>
    </section>
</template>

<script lang="ts">
import { defineComponent as component } from "vue";
import { mapGetters as getters } from "vuex";

import Navbar from "@Components/MainNavbar.vue";

export default component({
    components: {
        Navbar
    },
    computed: getters(["isLoggedIn"])
});
</script>
