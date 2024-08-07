# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog], and this project adheres to [Semantic
Versioning].

**Read it also in: [Español], [Português Brasileiro]**

## [Unreleased]

- Wiki on different languages
- GitHub Pull Requests templates

## [0.0.14] - 2024-08-01

### Added

- Code Owners file

### Fixed

- Typescript error on List page
- Git Attributes of binary files

## [0.0.13] - 2023-06-07

### Implemented

- Unit testing on User API Routes
- Unit testing on Dat API Routes

### Added

- New trait to get the storage path of `.dat` and `.done.dat` files based on the
  implementing class
- Environment keys for unit testing
- Readme files unit testing tutorial

### Fixed

- Ignored JavaScript files Prettier and ESLint errors
- Artisan commands wrong or missing exit codes
- Routes with ID paths regex
- Various misspellings on doc comments

## [0.0.12] - 2023-06-02

### Improved

- Git Ignore list and Git Attributes list styling
- Prettier line width, thus readability of JavaScript and TypeScript files

### Fixed

- Incorrect paths for badges on main readme

## [0.0.11] - 2023-05-31

### Added

- Changelog on different languages

### Updated

- [Keep a Changelog] URL to new version
- Some Composer packages
- Sass Folder Name

### Fixed

- Documentation files with incorrect words or styling

## [0.0.10] - 2023-03-14

### Implemented

- Dump function on Menu

### Improved

- Sass styling of the main screen
- Casting on some Vue files

### Added

- License headers on missing files

## [0.0.9] - 2023-03-13

### Created

- New Listage Vue Page
- Listage Page Component
- Verify Auth API Route

### Implemented

- No Content API Response

### Added

- Comments annotations on TypeScript interfaces

### Other

- Separated completely TypeScript from Vue files
- Altered Vue file structure

## [0.0.8] - 2023-02-25

### Created

- New Dat Vue Page
- Dashboard Page Component

### Implemented

- Vue Auth Middleware

### Added

- Composer [squizlabs/php_codesniffer] Package
- Comments annotations and types on missing PHP files

### Improved

- PHP coding styling in all files
- Vue coding styling in most of the files

## [0.0.7] - 2023-02-13

### Created

- Dashboard Vue Page
- Page Vue Layout

### Implemented

- Last Done Dat API Route
- TypesScript Response Data interfaces with keys

### Improved

- Versions of Composer and NPM packages
- PHP files commentaries and namespace usages

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

- General readability on some JavaScript and TypeScript files

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

- Documented PHP files as of Laravel's Standards
- Set documentation for GitHub's Community Standards

[Keep a Changelog]: https://keepachangelog.com/en/1.1.0/
[Semantic Versioning]: https://semver.org/spec/v2.0.0.html
[Español]: CHANGELOG.ES.md
[Português Brasileiro]: CHANGELOG.PT-BR.md
[Unreleased]: https://github.com/Mestre-Tramador/Exper-Dat-Reader/compare/v0.0.14...HEAD
[0.0.14]: https://github.com/Mestre-Tramador/Exper-Dat-Reader/compare/v0.0.13...v0.0.14
[0.0.13]: https://github.com/Mestre-Tramador/Exper-Dat-Reader/compare/v0.0.12...v0.0.13
[0.0.12]: https://github.com/Mestre-Tramador/Exper-Dat-Reader/compare/v0.0.11...v0.0.12
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
