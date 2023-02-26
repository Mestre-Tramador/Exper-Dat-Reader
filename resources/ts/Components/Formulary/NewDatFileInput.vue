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
    <div
        class="border-dashed border-2 w-64 h-32 rounded flex justify-center items-center cursor-pointer"
        :class="{
            'hover:text-gray-400': !error,
            'text-red-500 hover:text-red-300': error
        }"
        @dragover.prevent="($event: DragEvent) => (isDragging = true)"
        @dragleave="($event: DragEvent) => (isDragging = false)"
        @drop.prevent="setFiles"
        @click="useInput"
    >
        <input
            :id="id"
            :ref="id"
            type="file"
            class="hidden"
            :value="modelValue"
            multiple
            @change="emitFiles"
        />

        <document-arrow-up-icon class="w-6 h6" />

        <span v-if="!error" class="block">Drop your files here</span>
        <span v-else class="block italic">{{ error }}</span>
    </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";

import { DocumentArrowUpIcon } from "@heroicons/vue/24/solid";

export default defineComponent({
    components: {
        DocumentArrowUpIcon
    },
    props: {
        /**
         * The Element `id` attribute.
         */
        id: {
            type: String,
            required: true
        },

        /**
         * The error to present.
         */
        error: {
            type: String,
            required: true
        },

        /**
         * The `v-model` emitter.
         */
        modelValue: {
            type: Array,
            required: true
        }
    },
    emits: ["update:modelValue"],
    setup() {
        return {
            /**
             * Get all the files on the input, put them on an array
             * and finally emit it.
             *
             * @param input The input to get the files.
             * @returns The files as an array, not a {@link FileList}
             */
            rechangeFiles(input: HTMLInputElement): File[] {
                /**
                 * The new array for the files.
                 */
                const files: File[] = [];

                if (input.files) {
                    for (const file of input.files) {
                        files.push(file);
                    }
                }

                return files;
            }
        };
    },
    data() {
        return {
            /**
             * Key to determine if the files are
             * being dragged to the input.
             */
            isDragging: false
        };
    },
    methods: {
        /**
         * Set the files of the input and emit them.
         *
         * @param event The drag event on the input.
         */
        setFiles(event: DragEvent): void {
            this.isDragging = false;

            if (event.dataTransfer?.files) {
                this.getInput().files = event.dataTransfer?.files;
            }

            this.emitFiles();
        },

        /**
         * Emit the files as an array.
         */
        emitFiles(): void {
            this.$emit(
                "update:modelValue",
                this.rechangeFiles(this.getInput())
            );
        },

        /**
         * Get the current input as a Ref.
         *
         * @returns The input is an HTML Element.
         */
        getInput(): HTMLInputElement {
            return this.$refs[this.id] as HTMLInputElement;
        },

        /**
         * Quickly reproduce a click on the input.
         */
        useInput(): void {
            this.getInput().click();
        }
    }
});
</script>
