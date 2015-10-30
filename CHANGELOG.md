# Change Log
All notable changes to this project will be documented in this file. This project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]
## [0.0] - 10/27/2015
### Added
- added enqued stylesheets and scripts
- added menus
- added maximun content width
- added sidebars
- added Table of Contents to `theme.scss`

## [0.0] - 10/23/2015
### Added
- added landmark ARIA roles to common tags
- added more organized structure to the `scss` directory
- added files and folders that make it easier to keep CSS/SCSS modular
- added `js` folder and files
- added `images` folder
- added `fonts` folder
- added `inc/templates` folder
- added `.editorconfig`
- added theme support for post formats
- added theme support for HTML5 elements

### Changed
- converted all tags to HTML5 specs
- replaced `lang="en"` with  `<?php language_attributes(); ?>` in the `<html>` tag. This is documented to be a better practice.
- replaced `<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">` with `<meta charset="<?php bloginfo( 'charset' ); ?>">`. This has been documented to be better practice.
- restructured `form` elements for common practices
- updated the `@import` path in `style.css`
- renamed `style.css` to `theme.css` for easier recognition
- replaced any shorthand PHP syntax for WordPress standard syntax
- fixed basic indentation
- converted all braces in conditionals to the alternate colon syntax
- upgraded jQuery to version 1.11.3
- cleaned up the `functions.php`
- renamed functions in `functions.php` to match WordPress coding standards
- registered a Footer menu by default
- updated `.gitignore` to include common programming environments
