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
    <div :class="`mb-${bottom}`">
        <label class="block text-gray-700 text-sm font-bold mb-2" :for="id">
            {{ label }}
        </label>

        <input
            :id="id"
            :type="type"
            :value="modelValue"
            class="shadow appearance-none border rounded w-full py-2 x-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            :class="{ 'border-red-500': errors.length > 0 }"
            @input="($event: Event) => $emit('update:modelValue', inputValue($event))"
        />

        <p v-for="(error, index) in errors" :key="index" class="text-red-500 text-xs italic">
            {{ error }}
        </p>
    </div>
</template>

<script lang="ts">
import { defineComponent as component } from "vue";

export default component({
    props: {
        /**
         * The Element `id` attribute.
         */
        id: {
            type: String,
            required: true
        },

        /**
         * Text to present on the `label` Element.
         */
        label: {
            type: String,
            required: true
        },

        /**
         * The Element `type` attribute.
         */
        type: {
            type: String,
            required: true
        },

        /**
         * Bottom margin value for separations.
         */
        bottom: {
            type: Number,
            required: false,
            default: 0
        },

        /**
         * The list of errors to present.
         */
        errors: {
            type: Array,
            required: true
        },

        /**
         * The `v-model` emitter.
         */
        modelValue: {
            type: String,
            required: true
        }
    },
    emits: ["update:modelValue"],
    setup() {
        return {
            /**
             * Get the value of the input to emit.
             *
             * @param event The event on the input.
             * @returns The value on the input, or nothing.
             */
            inputValue(event: Event | null): string | undefined {
                return (event?.target as HTMLInputElement | null)?.value;
            }
        };
    }
});
</script>
