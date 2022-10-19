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

import { User as StateUser } from "vuex-types";

export class User {
    //#region Constructor
    /**
     * The constructor is private and only sets the properties.
     *
     * @param _id The User's ID.
     * @param _name The User's name.
     * @param _email The User's email.
     * @param _creation The User's creation date.
     */
    private constructor(
        private _id: number,
        private _name: string,
        private _email: string,
        private _creation: string
    ) {}
    //#endregion

    //#region Static Constructors
    /**
     * Create an User model.
     *
     * @param id The ID on the Database.
     * @param name The name to show on screen.
     * @param email The email to show on screen.
     * @param creation The creation date to show in the profile section.
     * @returns If no error occurs, then the instance is created.
     * @throws {RangeError} When creation date is invalid.
     */
    public static from(
        id: number,
        name: string,
        email: string,
        creation: string
    ): User {
        /**
         * Simple holder to see if creation date is valid.
         */
        const date: Date = new Date(creation);

        if (isNaN(date.getTime())) {
            throw new RangeError(`${date.toString()}!`);
        }

        return new this(id, name, email, creation);
    }

    /**
     * Create an User model from the one store in the {@link StateUser|State}.
     *
     * @param user The user on the state.
     * @returns If no error occurs, then the instance is created.
     * @throws {RangeError} When creation date is invalid.
     */
    public static fromState(user: StateUser): User {
        return User.from(user.id, user.name, user.email, user.creation);
    }
    //#endregion

    //#region Getters
    /**
     * Get the User's ID.
     */
    public get id(): number {
        return this._id;
    }

    /**
     * Get the User's name.
     */
    public get name(): string {
        return this._name;
    }

    /**
     * Get the User's email.
     */
    public get email(): string {
        return this._email;
    }

    /**
     * Get the User's creation date.
     */
    public get creation(): Date {
        return new Date(this._creation);
    }
    //#endregion
}
