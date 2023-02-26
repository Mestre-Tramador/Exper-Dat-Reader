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
    <head-page-layout title="Dashboard">
        <template #icon>
            <document-chart-bar-icon />
        </template>

        <template #page>
            <div class="grid grid-cols-2 gap-2 p-4 text-center">
                <card
                    v-for="(value, key) in data"
                    :key="key"
                    :title="translate(key)"
                    :data="normalize(value)"
                >
                    <template #icon>
                        <users-icon
                            v-if="key === 'customers_quantity'"
                            class="h-12 w-12"
                        />

                        <identification-icon
                            v-if="key === 'sellers_quantity'"
                            class="h-12 w-12"
                        />

                        <banknotes-icon
                            v-if="key === 'most_expensive_sale_id'"
                            class="h-12 w-12"
                        />

                        <arrow-trending-down-icon
                            v-if="key === 'worst_seller'"
                            class="h-12 w-12"
                        />
                    </template>
                </card>
            </div>
        </template>
    </head-page-layout>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { mapGetters } from "vuex";
import { AxiosError, AxiosResponse } from "axios";

import HeadPageLayout from "@Components/Layout/HeadPageLayout.vue";
import Card from "@Components/Dashboard/DashboardCard.vue";

import { DashboardData } from "@Interfaces/DashboardData";

import {
    ArrowTrendingDownIcon,
    BanknotesIcon,
    DocumentChartBarIcon,
    IdentificationIcon,
    UsersIcon
} from "@heroicons/vue/24/solid";

export default defineComponent({
    components: {
        HeadPageLayout,
        Card,
        ArrowTrendingDownIcon,
        BanknotesIcon,
        DocumentChartBarIcon,
        IdentificationIcon,
        UsersIcon
    },
    data() {
        return {
            /**
             * The data to present in the Dashboard.
             */
            data: {
                customers_quantity: null,
                sellers_quantity: null,
                most_expensive_sale_id: null,
                worst_seller: null
            } as DashboardData,

            /**
             * Keys the specific data presented in the Dashboard.
             */
            detail: null as keyof DashboardData | null,

            /**
             * Error message, if any.
             */
            error: null as unknown
        };
    },
    computed: mapGetters(["token"]),
    mounted() {
        this.$http
            .get("api/dump/last", {
                headers: {
                    Authorization: `Bearer ${this.token}`
                }
            })
            .then((res: AxiosResponse<DashboardData>) => (this.data = res.data))
            .catch((err: AxiosError) => (this.error = err.response?.data));
    },
    methods: {
        /**
         * Translate a key of the Dashobard to a readable content.
         *
         * @param key The key of the Dashboard.
         * @returns The string with the correct text.
         */
        translate(key: keyof DashboardData): string {
            switch (key) {
                case "customers_quantity":
                    return "Quantity of Customers";
                case "sellers_quantity":
                    return "Quantity of Sellers";
                case "most_expensive_sale_id":
                    return "ID of the most expensive Sale";
                case "worst_seller":
                    return "Current worst Seller";
            }
        },

        /**
         * Normalize the key data to prevent Typescript errors.
         *
         * @param value The same value from the Dashboard data.
         * @returns The data, only with its type fixed.
         */
        normalize(value: string | number | null): string | number | false {
            return value ?? false;
        }
    }
});
</script>
