<p id="exper-dat-reader" align="center">
    <a href="#exper-dat-reader">
        <img
            src="docs/assets/images/logo.png"
            alt="Exper-Dat-Reader logo"
            width="1282"
            height="140"
        />
    </a>
</p>

**Read it also in: [Español], [Português Brasileiro]**

---

<p align="center">

[![PHP](docs/assets/badges/php.svg)](https://www.php.net/)
[![TypeScript](docs/assets/badges/ts.svg)](https://www.typescriptlang.org/)
[![Sass](docs/assets/badges/sass.svg)](https://sass-lang.com/)
[![Lumen](docs/assets/badges/lumen.svg)](https://lumen.laravel.com/docs/9.x)
[![Vue](docs/assets/badges/vue.svg)](https://vuejs.org/)
[![Tailwind CSS](docs/assets/badges/tailwindcss.svg)](https://tailwindcss.com/)
[![SQLite](docs/assets/badges/sqlite.svg)](https://www.sqlite.org/index.html)

</p>

<p align="center">

[![Composer](docs/assets/badges/composer.svg)](https://getcomposer.org/)
[![Json Web Tokens](docs/assets/badges/jwt.svg)](https://jwt.io/)
[![npm](docs/assets/badges/npm.svg)](https://www.npmjs.com/)
[![PostCSS](docs/assets/badges/postcss.svg)](https://postcss.org/)
[![ESLint](docs/assets/badges/eslint.svg)](https://eslint.org/)
[![Prettier](docs/assets/badges/prettier.svg)](https://prettier.io/)
[![EditorConfig](docs/assets/badges/editorconfig.svg)](https://editorconfig.org/)
[![Keep a Changelog](docs/assets/badges/changelog.svg)](https://keepachangelog.com/en/1.1.0/)

</p>

The Exper-Dat-Reader is a project based on an old test to a job application which
required a PHP/JS system to read encrypted `.dat` files and dump their data into
`.done.dat` files.

## The Project

In order to train the aforementioned languages, and also improve my GitHub profile,
I decided to make this project anew using the [Lumen] framework with [SQLite] as
database. The the frontend works with a simple [Vue.js] application.

## How to run

Currently the process is very simple to make this beauty run on your computer. Please,
certify that you are running all the commands on this steps on the root of the project.

Firstly you're gonna to need run the following command:

```sh
    composer install
```

This will make all the PHP dependencies to be installed. Be sure to have [Composer]
installed either locally or globally on your machine.

After that, please run the following commands:

```sh
    cp .env.example .env

    php artisan make:key
    php artisan jwt:secret
```

These ones will set your env file and also your App Key and JWT Secret Key. Finally,
run the below commands to set up your SQLite Database:

```sh
    touch database/database.sqlite

    php artisan migrate
```

**Please be sure to have the absolute path to the `sqlite` file set on your `.env`**
**file, like this one:**

```ini
    DB_DATABASE=/home/your-user/Exper-Dat-Reader/database/database.sqlite

    # Windows and Mac users shall differ.
```

From now on, the backend is OK and ready to go! Just run the last command and
have fun:

```sh
    php artisan serve

    # Alternatively you can run `php -S localhost:8000 -t public`.
```

For the frontend, please open a new terminal window and run the following command:

```sh
    npm install
```

After all Node.js modules are installed, you just have to run this command:

```sh
    npm run watch

    # To just compile the files, please run `npm run dev`.
```

## Contribution

If you are interested on contribute, please consider read the [Contribution Guidelines].

Also, if is of your desire to fork this code, please be sure to do it! Always have
faith in your the code, nonetheless!

## License

Exper-Dat-Reader is currently licensed under the [GNU GENERAL PUBLIC LICENSE Version
3].

[Español]: docs/README.ES.md
[Português Brasileiro]: docs/README.PT-BR.md
[Lumen]: https://lumen.laravel.com/docs/9.x
[SQLite]: https://www.sqlite.org/index.html
[Vue.js]: https://vuejs.org/
[Composer]: https://getcomposer.org/
[Contribution Guidelines]: docs/CONTRIBUTING.md
[GNU GENERAL PUBLIC LICENSE Version 3]: LICENSE
