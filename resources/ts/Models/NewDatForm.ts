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

import { NewDatFormErrors } from "@Interfaces/NewDatFormErrors";
import { NewDatFormProps } from "@Interfaces/NewDatFormProps";

import { Form } from "@Models/Form";

/**
 * This form is used for multi-file uploads purposes,
 * so it follows its own {@link NewDatFormProps|Properties}.
 *
 * @author Mestre-Tramador
 */
export class NewDatForm extends Form<NewDatFormProps> {
    /**
     * The files stored to upload.
     */
    public dats: File[];

    /** @inheritdoc */
    public get errors(): NewDatFormErrors {
        return super.errors as NewDatFormErrors;
    }

    /**
     * Create the Form.
     *
     * @param dats An initial value for the {@link NewDatForm.dats|Dat files}.
     * @returns The form have the given values and no initial errors.
     */
    public static create(dats: File[] = []): NewDatForm {
        return super._create<NewDatFormProps>({ dats }) as NewDatForm;
    }
}
