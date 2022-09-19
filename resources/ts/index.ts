/*********************************************************\
 *   This file is meant to load all Vue.js components    *
 *  and routes to export them solely to the app.js file. *
\*********************************************************/
import { VueComponents, VueRoutes } from "vue-types";

import LandingIndex from "./Pages/Landing/LandingIndex.vue";

/**
 * All the Components present on the app
 * that shall be rendered.
 */
export const components: VueComponents = {
    LandingIndex
};

/**
 * All the Routes of the app that lead
 * to its multiples Components.
 */
export const routes: VueRoutes = [
    {
        path: "",
        component: LandingIndex
    }
];
