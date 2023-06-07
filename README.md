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
  <a href="https://www.php.net/">
    <img src="docs/assets/badges/php.svg" alt="PHP" />
  </a>

  <a href="https://www.typescriptlang.org/">
    <img src="docs/assets/badges/ts.svg" alt="TypeScript" />
  </a>

  <a href="https://sass-lang.com/">
    <img src="docs/assets/badges/sass.svg" alt="Sass" />
  </a>

  <a href="https://lumen.laravel.com/docs/9.x">
    <img src="docs/assets/badges/lumen.svg" alt="Lumen" />
  </a>

  <a href="https://vuejs.org/">
    <img src="docs/assets/badges/vue.svg" alt="Vue" />
  </a>

  <a href="https://tailwindcss.com/">
    <img src="docs/assets/badges/tailwindcss.svg" alt="Tailwind CSS" />
  </a>

  <a href="https://www.sqlite.org/index.html">
    <img src="docs/assets/badges/sqlite.svg" alt="SQLite" />
  </a>
</p>

<p align="center">
  <a href="https://getcomposer.org/">
    <img src="docs/assets/badges/composer.svg" alt="Composer" />
  </a>

  <a href="https://jwt.io/">
    <img src="docs/assets/badges/jwt.svg" alt="Json Web Tokens" />
  </a>

  <a href="https://www.npmjs.com/">
    <img src="docs/assets/badges/npm.svg" alt="npm" />
  </a>

  <a href="https://postcss.org/">
    <img src="docs/assets/badges/postcss.svg" alt="PostCSS" />
  </a>

  <a href="https://eslint.org/">
    <img src="docs/assets/badges/eslint.svg" alt="ESLint" />
  </a>

  <a href="https://prettier.io/">
    <img src="docs/assets/badges/prettier.svg" alt="Prettier" />
  </a>

  <a href="https://editorconfig.org/">
    <img src="docs/assets/badges/editorconfig.svg" alt="EditorConfig" />
  </a>

  <a href="https://keepachangelog.com/en/1.1.0/">
    <img src="docs/assets/badges/changelog.svg" alt="Keep a Changelog" />
  </a>
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

<details>
  <summary>
    Show...
  </summary>

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

</details>

## Unit Testing

Before running the unit tests, please consider setting up an environment for it,
or your data may be lost on some cleaning up of the files and databases. To make
it, you'll need to follow some few steps, and then you will be suited up to use
the test commands.

<details>
  <summary>
    Show...
  </summary>

  Firstly, create and additional database and populate it with the migrations.

  ```sh
    touch database/test.sqlite

    php artisan migrate
  ```

  **Remember to change it on your `.env` file!**

  Below is an example:

  ```ini
    # You can keep the two files.
    # DB_DATABASE=/home/your-user/Exper-Dat-Reader/database/database.sqlite
    DB_DATABASE=/home/your-user/Exper-Dat-Reader/database/test.sqlite
  ```

  Also on your `.env` file, create a `.dat` file at any folder and put
  the absolute path to it on the **TEST_FILE** key. Don't forget to fill
  the file with data.

  ```sh
    mkdir storage/app/samples

    touch storage/app/samples/exper.dat
  ```

  Again, in the `.env` file there must be an absolute path.

  ```ini
    TEST_FILE=/home/your-user/Exper-Dat-Reader/storage/app/samples/exper.dat
  ```

  The last thing you need to do is create a folder under the `storage/` one to
  have the files saved on the tests. You can choose any name, but the directory
  structure should be preserved.

  ```sh
    mkdir storage/app/test
    mkdir storage/app/test/data
    mkdir storage/app/test/data/in
    mkdir storage/app/test/data/out
  ```

  Just the name of the folder must be used on the `.env` file.

  ```ini
    TEST_FOLDER=test/

    # Ending slash is optional.
  ```

</details>

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
