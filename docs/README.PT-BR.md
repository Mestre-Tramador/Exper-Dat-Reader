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

**Leia também em: [English], [Español]**

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

Exper-Dat-Reader é um projeto baseado em um antigo teste para uma vaga de trabalho
que exigia que um sistema PHP/JS lesse arquivos `.dat` criptografados e despejasse
seus dados em arquivos `.done.dat`.

## O Projeto

Para treinar as linguagens mencionadas e também melhorar meu perfil no GitHub,
resolvi fazer esse projeto de novo usando o [Lumen] framework com [SQLite] como
banco de dados. O frontend opera com uma aplicação [Vue.js] simples.

## Como Executar

Atualmente o processo é bem simples para fazer essa belezura rodar no seu computador.
Por favor, certifique-se de que você está executando todos os comandos destas etapas
na raiz do projeto.

Primeiramente você vai precisar executar o seguinte comando:

```sh
    composer install
```

Isso fará com que todas as dependências PHP sejam instaladas. Certifique-se de ter
o [Composer] instalado local ou globalmente em sua máquina.

Depois disso, execute os seguintes comandos:

```sh
    cp .env.example .env

    php artisan make:key
    php artisan jwt:secret
```

Esses definirão seu arquivo env e também sua App Key e Secret Key do JWT. Por fim,
execute os comandos abaixo para configurar seu banco de dados SQLite:

```sh
    touch database/database.sqlite

    php artisan migrate
```

**Certifique-se de ter o caminho absoluto para o arquivo `sqlite` definido em seu**
**arquivo `.env`, como este:**

```ini
    DB_DATABASE=/home/seu-user/Exper-Dat-Reader/database/database.sqlite

    # Os usuários de Windows e Mac devem ser diferentes.
```

A partir de agora, o backend está OK e pronto para seguir! Basta executar o
último comando e se divertir:

```sh
    php artisan serve

    # Alternativamente, você pode executar `php -S localhost:8000 -t public`
```

Para o frontend, por favor abra um novo terminal e executando o seguinte comando:

```sh
    npm install
```

Depois de todos os módulos Node.js serem instalando, você só precisa executar esse
comando:

```sh
    npm run watch

    # Para apenas compilar os arquivos, execute `npm run dev`.
```

## Contribuição

Se você estiver interessado em contribuir, leia as [Diretrizes de Contribuição].

Além disso, se você deseja fazer um fork deste código, não deixe de fazê-lo!
Sempre tenha fé em seu código, não para menos!

## Licença

O Exper-Dat-Reader está atualmente licenciado sob a [LICENÇA PÚBLICA GERAL GNU Versão
3].

[English]: .README.md
[Español]: docs/README.ES.md
[Lumen]: https://lumen.laravel.com/docs/9.x
[SQLite]: https://www.sqlite.org/index.html
[Vue.js]: https://vuejs.org/
[Composer]: https://getcomposer.org/
[Diretrizes de Contribuição]: CONTRIBUTING.PT-BR.md
[LICENÇA PÚBLICA GERAL GNU Versão 3]: .LICENSE
