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

import { AuthFormErrors } from "@Interfaces/AuthFormErrors";
import { AuthFormProps } from "@Interfaces/AuthFormProps";

import { Form } from "@Models/Form";

/**
 * This form is used for authentication purposes,
 * so it follows its own {@link AuthFormProps|Properties}.
 *
 * @author Mestre-Tramador
 */
export class AuthForm extends Form<AuthFormProps> {
    /**
     * The email to login.
     */
    public email: string;

    /**
     * The password to login.
     */
    public password: string;

    /** @inheritdoc */
    public get errors(): AuthFormErrors {
        return super.errors as AuthFormErrors;
    }

    /**
     * Create the form.
     *
     * @param email An initial value for the {@link AuthForm.email|Email}.
     * @param password An initial value for the {@link AuthForm.password|Password}.
     * @returns The form have the given values and no initial errors.
     */
    public static create(email = "", password = ""): AuthForm {
        return super._create<AuthFormProps>({ email, password }) as AuthForm;
    }
}
