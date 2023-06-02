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

import { DatData } from "@Interfaces/DatData";
import { UserData } from "@Interfaces/UserData";
import { User } from "./User";

/**
 * The main files that have the data of all system.
 *
 * @author Mestre-Tramador
 */
export class Dat {
    //#region Constructor
    /**
     * The constructor is private and only sets the properties.
     *
     * @param _id The file's ID.
     * @param _name The file's save name.
     * @param _first_read The file's first read date.
     * @param _last_read The file's last read date.
     * @param _user The User that uploaded the file.
     */
    private constructor(
        private _id: number,
        private _name: string,
        private _first_read: string,
        private _last_read: string,
        private _user: UserData
    ) {}
    //#endregion

    //#region Static Constructors
    /**
     * Create a Dat model.
     *
     * @param id The ID on the Database.
     * @param name The name to show on screen.
     * @param first_read The first read date to show on screen.
     * @param last_read The first read date to show on screen.
     * @param user The User model.
     * @returns If no error occurs, then the instance is created.
     */
    public static from(
        id: number,
        name: string,
        first_read: string,
        last_read: string,
        user: UserData
    ): Dat {
        /**
         * Simple holder to first read date.
         */
        const first: Date = new Date(first_read);

        /**
         * Simple holder to last read date.
         */
        const last: Date = new Date(last_read);

        [first, last].forEach((date) => {
            if (isNaN(date.getTime())) {
                throw new RangeError(`${date.toString()}!`);
            }
        });

        if (first.getTime() > last.getTime()) {
            throw new RangeError(`${first.toString()} is bigger than ${last.toString()}!`);
        }

        return new this(id, name, first_read, last_read, user);
    }

    /**
     * Apply the static constructor to an array of Dats.
     *
     * @param data Multiple files to build.
     * @returns If no error occurs, then the instances are created.
     */
    public static fromData(data: DatData[]): Dat[] {
        return data.map((dat) =>
            this.from(dat.id, dat.name, dat.first_read, dat.last_read, dat.user)
        );
    }
    //#endregion

    //#region Getters
    /**
     * Get the Dat's ID.
     */
    public get id(): number {
        return this._id;
    }

    /**
     * Get the Dat's name.
     */
    public get name(): string {
        return this._name;
    }

    /**
     * Get the Dat's first read date.
     */
    public get first_read(): Date {
        return new Date(this._first_read);
    }

    /**
     * Get the Dat's last read date.
     */
    public get last_read(): Date {
        return new Date(this._last_read);
    }

    /**
     * Get the Dat's User.
     */
    public get user(): User {
        return User.from(this._user.id, this._user.name);
    }
    //#endregion

    //#region Public Methods
    /**
     * Check if a Dat is dumped.
     *
     * @returns `true` if the was already dumped.
     */
    public isDumped(): boolean {
        return this.first_read.getTime() < this.last_read.getTime();
    }
    //#endregion
}
