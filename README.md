# Exper-Dat-Reader

[![PHP](./docs/assets/badges/php.svg)](#exper-dat-reader-api)
[![Lumen](./docs/assets/badges/lumen.svg)](#exper-dat-reader-api)
[![SQLite](./docs/assets/badges/sqlite.svg)](#exper-dat-reader-api)
[![Json Web Tokens](./docs/assets/badges/jwt.svg)](#exper-dat-reader-api)
[![Keep a Changelog](./docs/assets/badges/changelog.svg)](#exper-dat-reader-api)

**Read it also in: [Español], [Português Brasileiro]**

The Exper-Dat-Reader is a project based on an old test to a job application which
required a PHP/JS system to read encrypted `.dat` files and dump their data into
`.done.dat` files.

## The Project

In order to train the aforementioned languages, and also improve my GitHub profile,
I decided to make this project anew using the [Lumen] framework with [SQLite] as
database. The plan is to increment it with a [Vue.js] frontend, always keeping the
simplicity of the idea.

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

From now on, you are all setup and ready to go! Just run the last command and
have fun:

```sh
    php artisan serve

    # Alternatively you can run `php -S localhost:8000 -t public`
```

## Contribution

Currently I'm working on a Contribution Guidelines file, soon it will be available
to anyone who seeks to help this project to be improved!

Also, if is of your desire to fork this code, please be sure to do it! Always have
faith in your the code, nonetheless!

## License

Exper-Dat-Reader is currently licensed under the [MIT License], as is Lumen.

[Español]: ./docs/README.ES.md
[Português Brasileiro]: ./docs/README.PT-BR.md
[Lumen]: https://lumen.laravel.com/docs/9.x
[SQLite]: https://www.sqlite.org/index.html
[Vue.js]: https://vuejs.org/
[Composer]: https://getcomposer.org/
[MIT License]: ./LICENSE
