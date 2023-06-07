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

<details>
  <summary>
    Mostrar...
  </summary>

  Primeiramente você vai precisar executar o seguinte comando:

  ```sh
    composer install
  ```

  Isso fará com que todas as dependências PHP sejam instaladas. Certifique-se de
  ter o [Composer] instalado local ou globalmente em sua máquina.

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

</details>

## Unit Testing

Antes de executar os testes, considere configurar um ambiente para isso, ou seus
dados podem ser perdidos em alguma limpeza dos arquivos e bancos de dados. Para
fazê-lo, você precisará seguir alguns passos, e então estará apto para usar os
comandos de teste.

<details>
  <summary>
    Mostrar...
  </summary>

  Em primeiro lugar, crie um banco de dados adicional e preencha-o com as migrações.

  ```sh
    touch database/test.sqlite

    php artisan migrate
  ```

  **Lembre-se de alterá-lo em seu arquivo `.env`!**

  Abaixo está um exemplo:

  ```ini
    # Você pode manter os dois arquivos.
    # DB_DATABASE=/home/seu-user/Exper-Dat-Reader/database/database.sqlite
    DB_DATABASE=/home/seu-user/Exper-Dat-Reader/database/test.sqlite
  ```

  Também em seu arquivo `.env`, crie um arquivo `.dat` em qualquer pasta e
  coloque o caminho absoluto para ele na key **TEST_FILE**. Não se esqueça de
  preencher o arquivo com os dados.

  ```sh
    mkdir storage/app/samples

    touch storage/app/samples/exper.dat
  ```

  Novamente, no arquivo `.env` deve haver um caminho absoluto.

  ```ini
    TEST_FILE=/home/seu-user/Exper-Dat-Reader/storage/app/samples/exper.dat
  ```

  A última coisa que você precisa fazer é criar uma pasta dentro da pasta `storage/`
  para ter os arquivos salvos nos testes. Você pode escolher qualquer nome,
  mas a estrutura de diretórios deve ser preservada.

  ```sh
    mkdir storage/app/test
    mkdir storage/app/test/data
    mkdir storage/app/test/data/in
    mkdir storage/app/test/data/out
  ```

  Apenas o nome da pasta deve ser usado no arquivo `.env`.

  ```ini
    TEST_FOLDER=test/

    # A barra final é opcional.
  ```

</details>

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
