# Exper-Dat-Reader

[![PHP](./assets/badges/php.svg)](#exper-dat-reader-api)
[![Lumen](./assets/badges/lumen.svg)](#exper-dat-reader-api)
[![SQLite](./assets/badges/sqlite.svg)](#exper-dat-reader-api)
[![Json Web Tokens](./assets/badges/jwt.svg)](#exper-dat-reader-api)
[![Keep a Changelog](./assets/badges/changelog.svg)](#exper-dat-reader-api)

**Léalo también en: [English], [Português Brasileiro]**

Exper-Dat-Reader es un proyecto basado en una prueba antigua para una solicitud
de empleo que requería un sistema PHP/JS para leer archivos `.dat` cifrados y
volcar sus datos en archivos `.done.dat`.

## El Proyecto

Para entrenar los lenguajes antes mencionados, y también mejorar mi perfil de GitHub,
decidí hacer este proyecto de nuevo usando el [Lumen] framework con [SQLite] como
base de datos. El plan es incrementarlo con un frontend [Vue.js], manteniendo siempre
el sencillez de la idea.

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

A partir de ahora, ¡ya está todo configurado y listo para comenzar! Solo ejecuta
el último comando y diviértete:

```sh
    php artisan serve

    # Alternativamente, puede ejecutar `php -S localhost:8000 -t public`
```

## Contribución

Actualmente estoy trabajando en un archivo de Pautas de Contribución, pronto estará
disponible a cualquiera que busque ayudar a que este proyecto sea mejorado!

Además, si desea bifurcar este código, ¡asegúrese de hacerlo! Sin embargo,
¡siempre ten fe en tu código!

## Licencia

Exper-Dat-Reader está licenciado actualmente bajo la [Licencia MIT], como es Lumen.

[English]: ../README.md
[Português Brasileiro]: ./README.PT-BR.md
[Lumen]: https://lumen.laravel.com/docs/9.x
[SQLite]: https://www.sqlite.org/index.html
[Vue.js]: https://vuejs.org/
[Composer]: https://getcomposer.org/
[Licencia MIT]: ../LICENSE
