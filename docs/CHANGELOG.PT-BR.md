# Changelog

Todas as alterações notáveis nesse projeto serão documentadas neste arquivo.

O formato é baseado em [Keep a Changelog], e esse projeto adere à [Semantic Versioning].

**Leia também em: [English], [Español]**

## [Não Publicado]

- Wiki em diferentes línguas
- Templates de Pull Requests do GitHub
- Unit Testing

## [0.0.11] - 2023-05-31

### Adicionado

- Changelog em diferentes línguas

### Atualizado

- URL do [Keep a Changelog] para uma nova versão
- Alguns pacotes do Composer
- Nome da pasta do Sass

### Corrigido

- Arquivos de documentação com palavras ou estilos incorretas

## [0.0.10] - 2023-03-14

### Implementado

- Função de Dump no Menu

### Melhorado

- Estilos de Sass da tela principal
- Casting em alguns arquivos Vue

### Adicionado

- Cabeçalhos de licença em arquivos faltantes

## [0.0.9] - 2023-03-13

### Criado

- Página Vue de Nova Listagem
- Componente de Página de Listagem
- Rota de API de Verificar Autenticação

### Implementado

- Resposta de API de Sem Conteúdo

### Adicionado

- Comentários em interfaces TypeScript

### Outros

- Separado completamente TypeScript de arquivos Vue
- Alterada estrutura de arquivos Vue

## [0.0.8] - 2023-02-25

### Criado

- Página Vue de Novo Dat
- Componente de Página de Dashboard

### Implementado

- Middleware Vue de Autenticação

### Adicionado

- Pacote [squizlabs/php_codesniffer] do Composer
- Comentários e tipagem em arquivos PHP faltantes

### Melhorado

- Estilo de código de PHP em todos os arquivos
- Estilo de código de Vue na maioria dos arquivos

## [0.0.7] - 2023-02-13

### Criado

- Página Vue de Dashboard
- Layout de Página Vue

### Implementado

- Rota de API de Último Dat Feito
- Interfaces TypeScript de Response Data com keys

### Melhorado

- Versões de pacotes do Composer e NPM
- Uso de comentários e namespaces em arquivos PHP

## [0.0.6] - 2022-10-18

### Criado

- Página Vue de Login
- Página Vue de Menu Principal
- Componente Vue de Barra de Navegação
- Componentes Vue de Inputs de Login

### Implementado

- Estrutura TypeScript de Form Model com Props e Errors
- Router Vue baseado nos nomes das rotas
- Persistência correta do estado de autenticação com Vuex

### Adicionado

- Rodapé em todas as páginas
- Cabeçalhos de licença em arquivos faltantes
- Pacote [@heroicons/vue] do NPM para ícones
- Imagem de usuário default

### Melhorado

- Legibilidade geral em alguns arquivos JavaScript e TypeScript

### Corrigido

- Ordens dos itens no Changelog
- Redirecionamentos incorretos das rotas da API ao App
- Resposta JSON da Rota de Login

## [0.0.5] - 2022-09-19

### Criado

- Controller do App para tratar o frontend
- Estrutura frontend com Laravel Mix e pacotes do NPM
- Primeira página com Vue.js e Tailwind CSS

### Adicionado

- Ícone Favicon
- ESLint e Prettier
- Arquivos de configuration para pacotes JavaScript
- Cabeçalhos de documentação na maioria dos arquivos

### Melhorado

- URLs em arquivos Markdown
- Textos e insígnias em arquivos leiame de Markdown

### Corrigido

- Espaçamento incorreto em templates de Issue do GitHub
- Rotas do frontend não funcionando corretamente

## [0.0.4] - 2022-09-08

### Criado

- Trait para instanciar respostas em Controllers e Middlewares

### Adicionado

- Templates de Issue do GitHub em diferentes línguas
- Cabeçalhos de licença em arquivos de código
- Comentários de classes

### Melhorado

- Agrupamento de rotas
- Chamadas de Resposta em Controllers
- Chamadas de Resposta em Middlewares
- Ordem dos métodos na Controller de Dat
- Ordem dos métodos na Controller de Dat Feito

### Changed

- Licença do MIT para GNU GPLv3
- Links em Markdown indexados ao fim do arquivo

## [0.0.3] - 2022-09-02

### Criado

- Model de arquivo Dat Feito
- Controller de arquivo Dat Feito
- Middleware de parse de FormData para método PUT
- Diretrizes de Contribuição
- Templates de Issues do GitHub

### Implementado

- Rota de API de Atualizar Dat
- Rota de API de Deletar Dat
- Rota de API de Dump
- Rota de API de Listar Dump
- Rota de API de Ler Dump
- Rota de API de Deletar Dump

### Adicionado

- Pacote [notihnio/php-multipart-form-data-parser] do Composer
- Logo
- Insígnias extras

### Melhorado

- Arquivos leiame

### Corrigido

- Regra deprecated de Markdown no EditorConfig
- Comando incorreto na documentação do arquivo `.env.example`
- Pequenos erros de escrita em documentação

## [0.0.2] - 2022-08-29

### Criado

- Model de arquivo Dat
- Middleware de arquivo Dat
- Controller de arquivo Dat
- Interface para arquivos `.dat` e `.done.dat` relacionados
- Trait para arquivos `.dat` e `.done.dat` relacionados

### Implementado

- Rota de API de Listar Dat
- Rota de API de Ler Dat
- Rota de API de Armazenar Dat

### Corrigido

- Estilo de documentação de código incorreto
- Espaçamento incorreto em algumas linhas de código
- Palavras erradas

## [0.0.1] - 2022-08-17

### Criado

- Comando `serve` do Artisan
- Comando `test` do Artisan
- Comando `make:key` do Artisan
- Arquivo de configuração para Autenticação do Lumen
- Arquivo de configuração para JWT
- Migration para a tabela de usuários
- Migration para a tabela dos arquivos `.dat`
- Migration para a tabela dos arquivos `.done.dat`
- Model de usuário
- Middleware de Autenticação
- Controller de Autenticação

### Implementado

- Rota de API de Registro (usuários)
- Rota de API de Login
- Rota de API de Logout

### Outros

- Arquivos PHP documentados pelos padrões Laravel
- Configurada documentação de acordo com os padrões da Comunidade do GitHub

[Keep a Changelog]: https://keepachangelog.com/en/1.1.0/
[Semantic Versioning]: https://semver.org/spec/v2.0.0.html
[Não Publicado]: https://github.com/Mestre-Tramador/Exper-Dat-Reader/compare/v0.0.11...HEAD
[0.0.11]: https://github.com/Mestre-Tramador/Exper-Dat-Reader/compare/v0.0.10...v0.0.11
[0.0.10]: https://github.com/Mestre-Tramador/Exper-Dat-Reader/compare/v0.0.9...v0.0.10
[0.0.9]: https://github.com/Mestre-Tramador/Exper-Dat-Reader/compare/v0.0.8...v0.0.9
[0.0.8]: https://github.com/Mestre-Tramador/Exper-Dat-Reader/compare/v0.0.7...v0.0.8
[0.0.7]: https://github.com/Mestre-Tramador/Exper-Dat-Reader/compare/v0.0.6...v0.0.7
[0.0.6]: https://github.com/Mestre-Tramador/Exper-Dat-Reader/compare/v0.0.5...v0.0.6
[0.0.5]: https://github.com/Mestre-Tramador/Exper-Dat-Reader/compare/v0.0.4...v0.0.5
[0.0.4]: https://github.com/Mestre-Tramador/Exper-Dat-Reader/compare/v0.0.3...v0.0.4
[0.0.3]: https://github.com/Mestre-Tramador/Exper-Dat-Reader/compare/v0.0.2...v0.0.3
[0.0.2]: https://github.com/Mestre-Tramador/Exper-Dat-Reader/compare/v0.0.1...v0.0.2
[0.0.1]: https://github.com/Mestre-Tramador/Exper-Dat-Reader/releases/tag/v0.0.1
[@heroicons/vue]: https://github.com/tailwindlabs/heroicons
[notihnio/php-multipart-form-data-parser]: https://github.com/notihnio/php-multipart-form-data-parser
[squizlabs/php_codesniffer]: https://github.com/squizlabs/php_codesniffer
