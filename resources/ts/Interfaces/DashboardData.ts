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
 * The response data of the
 * {@link https://github.com/Mestre-Tramador/Exper-Dat-Reader/wiki/API.Routes.DoneDatLast Last Done Dat} request.
 */
export interface DashboardData {
    /**
     * Quantity of Customers.
     */
    customers_quantity: number | null;

    /**
     * Quantity of Sellers.
     */
    sellers_quantity: number | null;

    /**
     * The ID of the most expensive sale.
     */
    most_expensive_sale_id: number | null;

    /**
     * Worst profit seller.
     */
    worst_seller: string | null;
}
