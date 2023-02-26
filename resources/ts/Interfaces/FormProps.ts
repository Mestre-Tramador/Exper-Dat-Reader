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

/**
 * Properties of a Form.
 *
 * Each property equals to a Form input.
 *
 * In the following example, the respective
 * object equates to a form with the `foo` and
 * `bar` inputs, the last with already a
 * value, *"zip"*.
 * @example
 * const props: FormProps = {
 *  foo: "",
 *  bar: "zip"
 * };
 */
export interface FormProps {
    [prop: string]: string | number | boolean | (File | File[]);
}
