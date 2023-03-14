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
    <layout title="Listage">
        <template #icon>
            <icon />
        </template>

        <template #page>
            <list id="listage" :dats="(dats as Dat[])" />
        </template>
    </layout>
</template>

<script lang="ts">
import { defineComponent as component } from "vue";
import { mapGetters as getters } from "vuex";

import { AxiosResponse as Response } from "axios";

import Layout from "@Components/HeadPageLayout.vue";
import List from "@Components/DatList.vue";

import { Dat } from "@Models/Dat";
import { DatData as Data } from "@Interfaces/DatData";
import { DocumentTextIcon as Icon } from "@heroicons/vue/24/solid";

export default component({
    components: {
        List,
        Layout,
        Icon
    },
    data() {
        return {
            /**
             * The Dats files to show on the list.
             */
            dats: [] as Dat[] | null
        };
    },
    computed: getters(["token"]),
    mounted() {
        this.$http
            .get("api/dat", {
                headers: {
                    Authorization: `Bearer ${this.token}`
                }
            })
            .then(
                (res: Response<Data[]>) => (this.dats = Dat.fromData(res.data))
            )
            .catch(() => (this.dats = null));
    }
});
</script>
