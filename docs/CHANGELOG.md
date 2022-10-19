# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog], and this project adheres to [Semantic
Versioning].

## [Unreleased]

- Changelog on different languages
- GitHub Pull Requests templates

## [0.0.6] - 2022-10-18

### Created

- Login Vue Page
- Main Menu Vue Page
- Navbar Vue Component
- Login Inputs Vue Component

### Implemented

- TypeScript Form Model structure with Props and Errors
- Vue Router based on routes' names
- Correct persisting of the authentication state with Vuex

### Added

- Footer on all pages
- License headers on missing files
- NPM [@heroicons/vue] package for icons
- Default user image

### Improved

- General readability on some JavaScript and Typescript files

### Fixed

- Changelog itens order
- Incorrect redirects of the API's routes to the App
- Login Route JSON response

## [0.0.5] - 2022-09-19

### Created

- App Controller to handle the frontend
- Frontend structure with Laravel Mix and NPM packages
- First page with Vue.js and Tailwind CSS

### Added

- Favicon icon
- ESLint and Prettier linting
- Configuration files for JavaScript packages
- Documentation headers on most files

### Improved

- URLs paths on Markdown files
- Badges and texts on Markdown readme files

### Fixed

- Incorrect spacing on GitHub Issue templates
- Frontend routes not working properly

## [0.0.4] - 2022-09-08

### Created

- Trait to construct responses on Controllers and Middlewares

### Added

- GitHub Issue templates on different languages
- License Headers on source files
- Classes commentaries

### Improved

- Route Grouping
- Response calls on Controllers
- Response calls on Middlewares
- Dat Controller methods order
- Done Dat Controller methods order

### Changed

- License from MIT to GNU GPLv3
- Markdown links to be indexed at the bottom of file

## [0.0.3] - 2022-09-02

### Created

- DoneDat file Model
- DoneDat file Controller
- FormData parser for PUT method Middleware
- Contribution Guidelines
- GitHub Issues templates

### Implemented

- Update Dat API Route
- Delete Dat API Route
- Dump API Route
- List Dump API Route
- Read Dump API Route
- Delete Dump API Route

### Added

- Composer [notihnio/php-multipart-form-data-parser] Package
- Logo image
- Extra badges

### Improved

- Markdown readme files

### Fixed

- EditorConfig deprecated Markdown rule
- Incorrect command on `.env.example` file documentation
- Minor word errors on code documentation

## [0.0.2] - 2022-08-29

### Created

- Dat file model
- Dat file Middleware
- Dat file Controller
- Interface for related `.dat` and `.done.dat` files
- Trait for related `.dat` and `.done.dat` files

### Implemented

- List Dat API Route
- Read Dat API Route
- Store Dat API Route

### Fixed

- Incorrect code documentation styling
- Incorrect spaces on some lines of code
- Misspelled words

## [0.0.1] - 2022-08-17

### Created

- Artisan `serve` command
- Artisan `test` command
- Artisan `make:key` command
- Config file for Lumen's Auth
- Config file for JWT
- Migration for Users table
- Migration for `.dat` files table
- Migration for `.done.dat` files table
- User model
- Authentication Middleware
- Authentication Controller

### Implemented

- Register API Route (Users)
- Login API Route
- Logout API Route

### Other

- Initial Commit
- Documented PHP files as of Laravel's Standards
- Set documentation for Github's Community Standards

[Keep a Changelog]: https://keepachangelog.com/en/1.0.0/
[Semantic Versioning]: https://semver.org/spec/v2.0.0.html
[Unreleased]: https://github.com/Mestre-Tramador/Exper-Dat-Reader/compare/v0.0.6...HEAD
[0.0.6]: https://github.com/Mestre-Tramador/Exper-Dat-Reader/compare/v0.0.5...v0.0.6
[0.0.5]: https://github.com/Mestre-Tramador/Exper-Dat-Reader/compare/v0.0.4...v0.0.5
[0.0.4]: https://github.com/Mestre-Tramador/Exper-Dat-Reader/compare/v0.0.3...v0.0.4
[0.0.3]: https://github.com/Mestre-Tramador/Exper-Dat-Reader/compare/v0.0.2...v0.0.3
[0.0.2]: https://github.com/Mestre-Tramador/Exper-Dat-Reader/compare/v0.0.1...v0.0.2
[0.0.1]: https://github.com/Mestre-Tramador/Exper-Dat-Reader/releases/tag/v0.0.1
[@heroicons/vue]: https://github.com/tailwindlabs/heroicons
[notihnio/php-multipart-form-data-parser]: https://github.com/notihnio/php-multipart-form-data-parser
