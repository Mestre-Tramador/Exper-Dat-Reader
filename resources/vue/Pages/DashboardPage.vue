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
    <layout title="Dashboard">
        <template #icon>
            <icon />
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
                        <customers-quantity-icon
                            v-if="key === 'customers_quantity'"
                            class="h-12 w-12"
                        />

                        <sellers-quantity-icon
                            v-if="key === 'sellers_quantity'"
                            class="h-12 w-12"
                        />

                        <most-expensive-sale-id-icon
                            v-if="key === 'most_expensive_sale_id'"
                            class="h-12 w-12"
                        />

                        <worst-seller-icon
                            v-if="key === 'worst_seller'"
                            class="h-12 w-12"
                        />
                    </template>
                </card>
            </div>
        </template>
    </layout>
</template>

<script lang="ts">
import { defineComponent as component } from "vue";
import { mapGetters as getters } from "vuex";
import { AxiosError as Error, AxiosResponse as Response } from "axios";

import Layout from "@Components/HeadPageLayout.vue";
import Card from "@Components/DashboardCard.vue";

import { DashboardData as Data } from "@Interfaces/DashboardData";

import {
    ArrowTrendingDownIcon as WorstSellerIcon,
    BanknotesIcon as MostExpensiveSaleIdIcon,
    DocumentChartBarIcon as Icon,
    IdentificationIcon as SellersQuantityIcon,
    UsersIcon as CustomersQuantityIcon
} from "@heroicons/vue/24/solid";

export default component({
    components: {
        Layout,
        Card,
        CustomersQuantityIcon,
        Icon,
        MostExpensiveSaleIdIcon,
        SellersQuantityIcon,
        WorstSellerIcon
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
            },

            /**
             * Keys the specific data presented in the Dashboard.
             */
            detail: null,

            /**
             * Error message, if any.
             */
            error: null
        } as { data: Data; detail: keyof Data | null; error: unknown };
    },
    computed: getters(["token"]),
    mounted() {
        this.$http
            .get("api/dump/last", {
                headers: {
                    Authorization: `Bearer ${this.token}`
                }
            })
            .then((res: Response<Data>) => (this.data = res.data))
            .catch((err: Error) => (this.error = err.response?.data));
    },
    methods: {
        /**
         * Translate a key of the Dashobard to a readable content.
         *
         * @param key The key of the Dashboard.
         * @returns The string with the correct text.
         */
        translate(key: keyof Data): string {
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
