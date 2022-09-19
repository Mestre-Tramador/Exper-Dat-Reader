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

import * as Vue from "vue";
import * as VueRouter from "vue-router";

import { components, routes } from "../ts/index.ts";

//#region Plugins
/**
 * The router manages and changes the pages and components
 * rendered on screen.
 *
 * All routes are made on a Typescript index.
 *
 * @type {VueRouter.Router}
 */
const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory(),
    routes
});
//#endregion

//#region App
/**
 * This Vue App is created using TypeScript components
 * and run all the frontend pages with its Router.
 *
 * The components are all grouped on a TypeScript index.
 *
 * @type {Vue.App<HTMLDivElement>}
 */
const app = Vue.createApp({ components });

app.use(router);

app.mount("#app");
//#endregion
