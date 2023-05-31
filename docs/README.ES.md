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

[![PHP](assets/badges/php.svg)](https://www.php.net/)
[![TypeScript](assets/badges/ts.svg)](https://www.typescriptlang.org/)
[![Sass](assets/badges/sass.svg)](https://sass-lang.com/)
[![Lumen](assets/badges/lumen.svg)](https://lumen.laravel.com/docs/9.x)
[![Vue](assets/badges/vue.svg)](https://vuejs.org/)
[![Tailwind CSS](assets/badges/tailwindcss.svg)](https://tailwindcss.com/)
[![SQLite](assets/badges/sqlite.svg)](https://www.sqlite.org/index.html)

</p>

<p align="center">

[![Composer](assets/badges/composer.svg)](https://getcomposer.org/)
[![Json Web Tokens](assets/badges/jwt.svg)](https://jwt.io/)
[![npm](assets/badges/npm.svg)](https://www.npmjs.com/)
[![PostCSS](assets/badges/postcss.svg)](https://postcss.org/)
[![ESLint](assets/badges/eslint.svg)](https://eslint.org/)
[![Prettier](assets/badges/prettier.svg)](https://prettier.io/)
[![EditorConfig](assets/badges/editorconfig.svg)](https://editorconfig.org/)
[![Keep a Changelog](assets/badges/changelog.svg)](https://keepachangelog.com/en/1.1.0/)

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

A partir de ahora, ¡ el backend está OK y listo para comenzar! Solo ejecuta
el último comando y diviértete:

```sh
    php artisan serve

    # Alternativamente, puede ejecutar `php -S localhost:8000 -t public`
```

Para el frontend, abra un nuevo terminal y ejecute el siguiente comando:

```sh
    npm install
```

Después de instalar todos los módulos del Node.js, solo tiene que ejecutar este comando:

```sh
    npm run watch

    # Para compilar los archivos, ejecute `npm run dev`.
```

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
