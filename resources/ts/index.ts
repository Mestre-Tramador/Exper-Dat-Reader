//#region License
/**
 * Exper-Dat-Reader is a system to read encrypted .dat files and dump their data into .done.dat files.
 *  Copyright (C) 2023  Mestre-Tramador
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

//#region Imports
import * as VuexPersist from "vuex-persist";

import axios from "axios";

import { AxiosResponse } from "axios";
import { User as UserModel } from "@Models/User";

import type { VueComponents, VueRoutes } from "vue-types";
import type {
    UserGetters,
    UserMutations,
    User,
    UserState,
    UserPlugins
} from "vuex-types";
import {
    NavigationGuardNext,
    NavigationGuardWithThis,
    RouteLocationNamedRaw,
    RouteLocationNormalized
} from "vue-router";

import DashboardPage from "@Pages/DashboardPage.vue";
import LoginPage from "@Pages/LoginPage.vue";
import IndexPage from "@Pages/IndexPage.vue";
import NewDatPage from "@Pages/NewDatPage.vue";
import ListagePage from "@Pages/ListagePage.vue";

import "vue-router/dist/vue-router";
import "vuex/types/vue";
import "vue-axios/index";

//#endregion

//#region Vue
/**
 * All the Components present on the app
 * that shall be rendered.
 */
const components: VueComponents = {
    DashboardPage,
    LoginPage,
    IndexPage,
    NewDatPage,
    ListagePage
};

/**
 * All the Routes of the app that lead
 * to its multiples Components.
 */
const routes: VueRoutes = [
    {
        path: "",
        name: "Index",
        component: IndexPage
    },
    {
        path: "/dashboard",
        name: "Dashboard",
        component: DashboardPage
    },
    {
        path: "/login",
        name: "Login",
        component: LoginPage
    },
    {
        path: "/new",
        name: "New Dat",
        component: NewDatPage
    },
    {
        path: "/list",
        name: "Listage",
        component: ListagePage
    }
];

/**
 * Middleware to guard the authentication of the app.
 *
 * @param to The destiny Route.
 * @param from The origin Route.
 * @param next Callback for the next step.
 */
const guard: NavigationGuardWithThis<UserGetters> = function (
    to: RouteLocationNormalized,
    from: RouteLocationNormalized,
    next: NavigationGuardNext
) {
    /**
     * Route object to make the redirect.
     */
    const route: RouteLocationNamedRaw = { name: "Login" };

    /**
     * Verify if the User is authenticated.
     */
    const authenticated = this.isAuthenticated as unknown as
        | Promise<AxiosResponse>
        | false;

    /**
     * Handle the request if the User
     * is authenticated.
     */
    const handleAuthenticated = (): void => {
        if (to.name === "Login") {
            route.name = "Index";

            next(route);

            return;
        }

        next();
    };

    /**
     * Handle the request if the User
     * is unauthenticated.
     */
    const handleUnauthenticated = (): void => {
        if (to.name !== "Login") {
            next(route);

            return;
        }

        next();
    };

    if (authenticated) {
        authenticated.then(handleAuthenticated).catch(handleUnauthenticated);

        return;
    }

    handleUnauthenticated();
};
//#endregion

//#region Vuex
/**
 * The initial state of the app's authentication.
 */
const state: UserState = {
    user: null,
    token: null
};

/**
 * The mutations of the state alter its two properties.
 */
const mutations: UserMutations = {
    /**
     * Set a new {@link User} on the state.
     *
     * @param state This state is currently loaded by Vuex.
     * @param user  The new User. Pass `null` to unset it.
     */
    setUser(state: UserState, user: User | null): void {
        state.user = user;
    },

    /**
     * Set a new JWT token on the state.
     *
     * @param state This state is currently loaded by Vuex.
     * @param token The new JWT token. Pass `null` to unset it.
     */
    setToken(state: UserState, token: string | null): void {
        state.token = token;
    }
};

/**
 * The getters serve to or validate the existence of a JWT token,
 * or to get the current authenticated {@link User} as a
 * {@link UserModel|Model}.
 */
const getters: UserGetters = {
    /**
     * Validate if the User is authenticated by the JWT Token.
     *
     * @param state This state is currently loaded by Vuex.
     * @returns `true` if the token is valid and present.
     */
    isLoggedIn(state: UserState): boolean {
        return !!state.token;
    },

    /**
     * Validate if the User is authenticated by the API.
     *
     * @param state This state is currently loaded by Vuex.
     * @returns `true` if the token is valid and present.
     */
    isAuthenticated(state: UserState) {
        if (!state.token) {
            return false;
        }

        return axios.get(`api/auth?token=${state.token}`);
    },

    /**
     * Transform the {@link User} on the state to a
     * {@link UserModel|Model}.
     *
     * This Model does not permit any alteration on the
     * data, so it's meant to read-only.
     *
     * @param state This state is currently loaded by Vuex.
     * @returns If there is no User, then it returns `null`.
     */
    user(state: UserState): UserModel | null {
        if (!state.user) {
            return null;
        }

        return UserModel.fromState(state.user);
    },

    /**
     * Retrieve the JWT Token based on the state of the {@link User}.
     *
     * @param state This state is currently loaded by Vuex.
     * @returns If the token is invalid, then it returns `null`.
     */
    token(state: UserState): string | null {
        return state.token;
    }
};
//#endregion

//#region Vuex Plugins
/**
 * This plugins persists the state on the storage
 * of the {@link window|Window}.
 */
const persistance: VuexPersist.VuexPersistence<UserState> =
    new VuexPersist.VuexPersistence<UserState>({
        storage: window.localStorage
    });

/**
 * All the plugins goes in the array.
 */
const plugins: UserPlugins = [persistance.plugin];
//#endregion

//#region Exporting
export { components, routes, guard, state, mutations, getters, plugins };
//#endregion
