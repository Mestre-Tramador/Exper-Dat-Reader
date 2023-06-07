<p id="exper-dat-reader" align="center">
    <a href="#exper-dat-reader">
        <img
            src="assets/images/logo.png"
            alt="Exper-Dat-Reader logo"
            width="1282"
            height="140"
        />
    </a>
</p>

**Léalo también en: [English], [Português Brasileiro]**

---

<p align="center">
  <a href="https://www.php.net/">
    <img src="assets/badges/php.svg" alt="PHP" />
  </a>

  <a href="https://www.typescriptlang.org/">
    <img src="assets/badges/ts.svg" alt="TypeScript" />
  </a>

  <a href="https://sass-lang.com/">
    <img src="assets/badges/sass.svg" alt="Sass" />
  </a>

  <a href="https://lumen.laravel.com/docs/9.x">
    <img src="assets/badges/lumen.svg" alt="Lumen" />
  </a>

  <a href="https://vuejs.org/">
    <img src="assets/badges/vue.svg" alt="Vue" />
  </a>

  <a href="https://tailwindcss.com/">
    <img src="assets/badges/tailwindcss.svg" alt="Tailwind CSS" />
  </a>

  <a href="https://www.sqlite.org/index.html">
    <img src="assets/badges/sqlite.svg" alt="SQLite" />
  </a>
</p>

<p align="center">
  <a href="https://getcomposer.org/">
    <img src="assets/badges/composer.svg" alt="Composer" />
  </a>

  <a href="https://jwt.io/">
    <img src="assets/badges/jwt.svg" alt="Json Web Tokens" />
  </a>

  <a href="https://www.npmjs.com/">
    <img src="assets/badges/npm.svg" alt="npm" />
  </a>

  <a href="https://postcss.org/">
    <img src="assets/badges/postcss.svg" alt="PostCSS" />
  </a>

  <a href="https://eslint.org/">
    <img src="assets/badges/eslint.svg" alt="ESLint" />
  </a>

  <a href="https://prettier.io/">
    <img src="assets/badges/prettier.svg" alt="Prettier" />
  </a>

  <a href="https://editorconfig.org/">
    <img src="assets/badges/editorconfig.svg" alt="EditorConfig" />
  </a>

  <a href="https://keepachangelog.com/en/1.1.0/">
    <img src="assets/badges/changelog.svg" alt="Keep a Changelog" />
  </a>
</p>

Exper-Dat-Reader es un proyecto basado en una prueba antigua para una solicitud
de empleo que requería un sistema PHP/JS para leer archivos `.dat` cifrados y
volcar sus datos en archivos `.done.dat`.

## El Proyecto

Para entrenar los lenguajes antes mencionados, y también mejorar mi perfil de GitHub,
decidí hacer este proyecto de nuevo usando el [Lumen] framework con [SQLite] como
base de datos. El frontend trabaja con una aplicación [Vue.js] simples.

## Como ejecutar

Actualmente, el proceso es muy simple para hacer que esta belleza se ejecute en
su computadora. Por favor, certifica que estás ejecutando todos los comandos de
estos pasos en la raíz del proyecto.

<details>
  <summary>
    Mostrar...
  </summary>

  En primer lugar, necesitará ejecutar el siguiente comando:

  ```sh
    composer install
  ```

  Esto hará que se instalen todas las dependencias de PHP. Asegúrese de tener [Composer]
  instalado local o globalmente en su máquina.

  Después de eso, ejecute los siguientes comandos:

  ```sh
    cp .env.example .env

    php artisan make:key
    php artisan jwt:secret
  ```

  Estos configurarán su archivo env y también su Key de Aplicación y Secret Key de
  JWT. Finalmente, ejecute los siguientes comandos para configurar su base de datos
  SQLite:

  ```sh
    touch database/database.sqlite

    php artisan migrate
  ```

  **Asegúrese de tener la ruta absoluta al archivo `sqlite` establecido en su archivo**
  **`.env`, como este:**

  ```ini
    DB_DATABASE=/home/tu-user/Exper-Dat-Reader/database/database.sqlite

    # Los usuarios de Windows y Mac serán diferentes.
  ```

  A partir de ahora, ¡el backend está OK y listo para comenzar! Solo ejecuta
  el último comando y diviértete:

  ```sh
    php artisan serve

    # Alternativamente, puede ejecutar `php -S localhost:8000 -t public`
  ```

  Para el frontend, abra un nuevo terminal y ejecute el siguiente comando:

  ```sh
    npm install
  ```

  Después de instalar todos los módulos del Node.js, solo tiene que ejecutar este
  comando:

  ```sh
    npm run watch

    # Para compilar los archivos, ejecute `npm run dev`.
  ```

</details>

## Unit Testing

Antes de ejecutar las pruebas, considere configurar un entorno para ellas, o sus
datos pueden perderse al limpiar algunos archivos y bases de datos. Para hacerlo,
deberá seguir algunos pasos y luego estará preparado para usar los comandos de prueba.

<details>
  <summary>
    Mostrar...
  </summary>

  En primer lugar, cree una base de datos adicional y complétele con las migrations.

  ```sh
    touch database/test.sqlite

    php artisan migrate
  ```

  **¡Recuerda cambiarlo en tu archivo `.env`!**

  Abajo se muestra un ejemplo:

  ```ini
    # Puedes conservar los dos archivos.
    # DB_DATABASE=/home/tu-user/Exper-Dat-Reader/database/database.sqlite
    DB_DATABASE=/home/tu-user/Exper-Dat-Reader/database/test.sqlite
  ```

  También en su archivo `.env`, cree un archivo `.dat` en cualquier carpeta y
  coloque la ruta absoluta en la key **TEST_FILE**. No olvides de llenar el archivo
  con datos.

  ```sh
    mkdir storage/app/samples

    touch storage/app/samples/exper.dat
  ```

  Nuevamente, en el archivo `.env` debe haber una ruta absoluta.

  ```ini
    TEST_FILE=/home/tu-user/Exper-Dat-Reader/storage/app/samples/exper.dat
  ```

  Lo último que debe hacer es crear una carpeta debajo de `storage/` para guardar
  los archivos de las pruebas. Puede elegir cualquier nombre, pero debe
  conservarse la estructura de directorios.

  ```sh
    mkdir storage/app/test
    mkdir storage/app/test/data
    mkdir storage/app/test/data/in
    mkdir storage/app/test/data/out
  ```

  Solo se debe usar el nombre de la carpeta en el archivo `.env`.

  ```ini
    TEST_FOLDER=test/

    # La barra inclinada final es opcional.
  ```

</details>

## Contribución

Si está interesado en contribuir, considere leer las [Pautas de Contribución].

Además, si desea bifurcar este código, ¡asegúrese de hacerlo! Sin embargo,
¡siempre ten fe en tu código!

## Licencia

Exper-Dat-Reader está licenciado actualmente bajo la [LICENCIA PÚBLICA GENERAL DE
GNU Versión 3].

[English]: .README.md
[Português Brasileiro]: README.PT-BR.md
[Lumen]: https://lumen.laravel.com/docs/9.x
[SQLite]: https://www.sqlite.org/index.html
[Vue.js]: https://vuejs.org/
[Composer]: https://getcomposer.org/
[Pautas de Contribución]: CONTRIBUTING.ES.md
[LICENCIA PÚBLICA GENERAL DE GNU Versión 3]: .LICENSE
