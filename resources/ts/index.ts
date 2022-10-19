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

//#region Imports
import * as VuexPersist from "vuex-persist";

import { User as UserModel } from "@Models/User";

import type { VueComponents, VueRoutes } from "vue-types";
import type {
    UserGetters,
    UserMutations,
    User,
    UserState,
    UserPlugins
} from "vuex-types";

import LoginPage from "@Pages/Auth/LoginPage.vue";
import MenuIndex from "@Pages/Menu/MenuIndex.vue";

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
    LoginPage,
    MenuIndex
};

/**
 * All the Routes of the app that lead
 * to its multiples Components.
 */
const routes: VueRoutes = [
    {
        path: "",
        name: "Menu",
        component: MenuIndex
    },
    {
        path: "/login",
        name: "Login",
        component: LoginPage
    }
];
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
export { components, routes, state, mutations, getters, plugins };
//#endregion
