//#region License
/**
 * Exper-Dat-Reader is a system to read encrypted .dat files and dump their data into .done.dat files.
 *  Copyright (C) 2022  Mestre-Tramador
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */
//#endregion

/**
 * "*Components allow us to split the UI into independent and reusable pieces,
 * and think about each piece in isolation. It's common for an app to be organized
 * into a tree of nested components.*"
 * @see https://vuejs.org/guide/essentials/component-basics.html
 * @author Mestre-Tramador
 */
declare module "*.vue" {
    import * as Vue from "vue";

    /**
     * Simple rename for the original type.
     */
    export type VueComponent = Vue.Component;
}

/**
 * These types are just a tool to handle the exporting on TypeScript files.
 * @author Mestre-Tramador
 */
declare module "vue-types" {
    import { VueComponent } from "*.vue";

    /**
     * Groups all components on a single object.
     * @see https://vuejs.org/guide/components/registration.html#global-registration
     */
    export type VueComponents = { [name: string]: VueComponent };

    /**
     * List the Routes on an Array with metadata.
     * @see https://router.vuejs.org/guide/#javascript
     */
    export type VueRoutes = [
        {
            path: string;
            component: VueComponent;
            name?: string;
            sensitive?: boolean;
        }
    ];
}
