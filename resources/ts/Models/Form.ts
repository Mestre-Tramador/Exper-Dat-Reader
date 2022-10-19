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

import { FormErrors } from "@Interfaces/FormErrors";
import { FormProps } from "@Interfaces/FormProps";

/**
 * Represents a `<form>` on a Page, where every and each
 * property of the class can be assigned to an `v-model`.
 *
 * @author Mestre-Tramador
 */
export class Form<P extends FormProps> {
    /**
     * Internally store the errors messages and
     * for each property.
     */
    private _errors: FormErrors = { message: "" };

    /**
     * The constructor is protected as the formulary is
     * built statically.
     *
     * @param props The param determine which properties this form will hold.
     */
    protected constructor(props: P) {
        Object.assign(this, props);

        for (const prop in props) {
            this.errors[prop] = [];
        }
    }

    /**
     * Create a new form according to the properties.
     *
     * The creation must be static because the type of the form can be used.
     *
     * @param props The type of the form is determined by is properties, all extended from the {@link FormProps|original} ones.
     * @returns     The instance follows the constructor only.
     */
    protected static _create<P extends FormProps>(props: P): Form<P> {
        return new this(props);
    }

    /**
     * The errors can be get through this getter
     * to prevent alterations.
     */
    public get errors(): FormErrors {
        return this._errors;
    }

    /**
     * Clear all values on the form.
     */
    public clear(): void {
        for (const prop in this) {
            if (prop !== "_errors") {
                switch (typeof this[prop]) {
                    case "number":
                        (this[prop] as number) = 0;
                        return;
                    case "boolean":
                        (this[prop] as boolean) = false;
                        return;
                    case "string":
                        (this[prop] as string) = "";
                        return;
                }
            }
        }
    }

    /**
     * Clear all error messages on the form.
     */
    public clearErrors(): void {
        for (const error in this._errors) {
            if (error === "message") {
                this._errors[error] = "";

                continue;
            }

            this._errors[error] = [];
        }
    }
}
