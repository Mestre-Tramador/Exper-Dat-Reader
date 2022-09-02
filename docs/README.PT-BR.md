# Exper-Dat-Reader

<!--  markdownlint-disable MD033  -->
<p align="center">
    <a href="#exper-dat-reader">
        <img
            src="./assets/images/logo.png"
            alt="Exper-Dat-Reader logo"
            width="1282"
            height="140"
        />
    </a>
</p>
<!--  markdownlint-enable MD033  -->

**Leia também em: [English], [Español]**

---

<!--  markdownlint-disable MD013 MD033  -->
<p align="center">
    <a href="https://www.php.net/" target="_blank"><img src="./assets/badges/php.svg" alt="PHP" /></a>
    <a href="https://lumen.laravel.com/docs/9.x" target="_blank"><img src="./assets/badges/lumen.svg" alt="Lumen" /></a>
    <a href="https://www.sqlite.org/index.html" target="_blank"><img src="./assets/badges/sqlite.svg" alt="SQLite" /></a>
</p>
<p align="center">
    <a href="https://getcomposer.org/" target="_blank"><img src="./assets/badges/composer.svg" alt="Composer" /></a>
    <a href="https://jwt.io/" target="_blank"><img src="./assets/badges/jwt.svg" alt="Json Web Tokens" /></a>
    <a href="https://editorconfig.org/" target="_blank"><img src="./assets/badges/editorconfig.svg" alt="EditorConfig" /></a>
    <a href="https://keepachangelog.com/en/1.0.0/" target="_blank"><img src="./assets/badges/changelog.svg" alt="Keep a Changelog" /></a>
</p>
<!--  markdownlint-enable MD013 MD033  -->

Exper-Dat-Reader é um projeto baseado em um antigo teste para uma vaga de trabalho
que exigia que um sistema PHP/JS lesse arquivos `.dat` criptografados e despejasse
seus dados em arquivos `.done.dat`.

## O Projeto

Para treinar as linguagens mencionadas e também melhorar meu perfil no GitHub,
resolvi fazer esse projeto de novo usando o [Lumen] framework com [SQLite] como
banco de dados. O plano é incrementá-lo com um frontend [Vue.js], sempre mantendo
a simplicidade da ideia.

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

A partir de agora, você está configurado e pronto para seguir! Basta executar o
último comando e se divertir:

```sh
    php artisan serve

    # Alternativamente, você pode executar `php -S localhost:8000 -t public`
```

## Contribuição

Se você estiver interessado em contribuir, leia as [Diretrizes de Contribuição].

Além disso, se você deseja fazer um fork deste código, não deixe de fazê-lo!
Sempre tenha fé em seu código, não para menos!

## Licença

O Exper-Dat-Reader está atualmente licenciado sob a [Licença MIT], assim como o Lumen.

[English]: ../README.md
[Español]: ./docs/README.ES.md
[Lumen]: https://lumen.laravel.com/docs/9.x
[SQLite]: https://www.sqlite.org/index.html
[Vue.js]: https://vuejs.org/
[Composer]: https://getcomposer.org/
[Diretrizes de Contribuição]: ./CONTRIBUTING.PT-BR.md
[Licença MIT]: ../LICENSE
