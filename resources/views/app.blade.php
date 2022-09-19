<!DOCTYPE html>
<html>
    <head>
        <!--
            Exper-Dat-Reader is a system to read encrypted .dat files and dump their data into .done.dat files.
            Copyright (C) 2022  Mestre-Tramador

            This program is free software: you can redistribute it and/or modify
            it under the terms of the GNU General Public License as published by
            the Free Software Foundation, either version 3 of the License, or
            (at your option) any later version.

            This program is distributed in the hope that it will be useful,
            but WITHOUT ANY WARRANTY; without even the implied warranty of
            MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
            GNU General Public License for more details.

            You should have received a copy of the GNU General Public License
            along with this program.  If not, see <https://www.gnu.org/licenses/>.
        -->

        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>Exper-Dat-Reader</title>

        <meta name="keywords" content="exper,lumen,dat,study" />
        <meta name="language" content="EN">
        <meta name="author" content="Mestre-Tramador" />
        <meta
            name="description"
            content="Exper-Dat-Reader is a system to read encrypted .dat
            files and dump their data into .done.dat files."
        />

        <link rel="icon" type="image/x-icon" href="favicon.ico" />

        <link rel="stylesheet" type="text/css" href="dist/css/tailwind.css" />
        <link rel="stylesheet" type="text/css" href="dist/css/app.css" />
    </head>

    <body class="leading-normal tracking-normal text-white gradient">
        <main id="app" class="flex h-screen w-screen">
            <router-view></router-view>
        </main>

        <script src="dist/js/app.js"></script>
    </body>
</html>
