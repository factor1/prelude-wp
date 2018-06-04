# Change Log
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## [4.2.4] - 2018-06-04
# Adds
- Better source mapping for styles, while it still does not point to the correct scss file, you can now see where it appears in `theme.css`

## [4.2.3] - 2018-05-25
# Updated
- npm dependencies
- eslint rule for comma dangle now is silenced 🤫

# Adds
- JS sourcemaps

## [4.2.2] - 2018-04-26
# Updated
- Travis node build

## [4.2.1] - 2018-04-26
# Updated
- browser-sync
- gulp-cssnano

# Removed
- yards

## [4.2.0] - 2018-03-21
# Updated
- All node_modules to their current versions

# Fixed
- Syntax error in Sass Gulp task

# Added
- npm version command to `gulp version` to auto update npm package versioning


## [4.1.0] - 2018-03-16
# Added
- Font Awesome 5 CDN to enqueues file
- Font Awesome 5 config file per the [Font Awesome documentation](https://fontawesome.com/how-to-use/svg-with-js#pseudo-elements)

# Update
- Changed social menu syntax to use Font Awesome 5 inline svgs

## [4.0.5] - 2018-02-27
# Update
- ESLint rules to be more in line with prelude settings/vision

## [4.0.4] - 2018-02-26
# Fix
- Travis file being included in copy script.

## [4.0.3] - 2018-01-12
# Fixes
- Fixes file move node script to ignore `util/` folder and all `.md` files.

# Updates
- Update bowser documentation to reflect correct comparison operator.

## [4.0.2] - 2017-10-20
# Fixes
- Fixes typo in bowser function, adjust operator for browser version check.

## [4.0.1] - 2017-09-19
# Updates
- Updates `.eslintrc` with custom rules

# Removes
- "standard" an npm package for ESLint rules

## [4.0.0] - 2017-09-15
# Updates
- Clean up of global scss from #104
- Remove vistited link style from #105
- Remove extra css from social menu - close #106
- Update nav menu registration - close #112

# Additions
- Add browser detection via Bowser - closes #107
- Add ESlint - close #110
- Add Merge Media Queries - closes #108
- Add prelude-init npm script to autopopulate `style.css` and parts of `gulpfile.js` - closes #99

# Removes
- Remove JSHint - close #110
- Removes `featuredBG` php function from `inc/thumbnails.php`

## [3.5.1] - 2017-06-02
# Fixes
- Missing git commit in gulp version tasks

## [3.5.0] - 2017-04-10
# Adds
- Adds new version feature, that allows theme version to be updated by `gulp version --minor`

## [3.4.3] - 2017-03-27
# Removes
- Removes jQuery enqueue from google CDN from issue #100. Thanks for the heads up @jeremyescott

## [3.4.2] - 2017-03-21
# Removes
- Removes opinionated structures from template files.
- Removes WP tweaks that were causing deprecation issues.

# Adds
- Adds sugar mixins for rems and aspect ratio
- Adds Yelp CSS for social menu


## [3.4.1] - 2016-12-19
# Update
- Updates npm dependencies

## [3.4.0] - 2016-12-16
# Update
- Updates default gulp task to run `styles` instead of `sass`
- Moves all theme files out of `/src/` and into the root folder

## [3.3.11] - 2016-12-01
# Removes
- Removes hiding of post author div

## [3.3.11] - 2016-11-21
### Fixes and Additions
- Fixes missing dependency `imagemin-pngquant`
- Fixes missing default argument for `featuredURL()`
- Adds `THEME_VERSION` constant to better enqueue JS and CSS files (avoiding cache issues)

## [3.3.10] - 2016-10-13
### Added
- Adds function to expand WordPress toolkit/kitchen sink for all users by default.

## [3.3.9] - 2016-10-11
### Removed
- Removes the `postinstall` script all together to avoid changes to user themes and also greatly increase compatibility across platforms. Also updates readme with this change.

## [3.3.8] - 2016-10-05
### Change
- Changes the WordPress jQuery handle from `prelude_wp` to `jquery` for better plugin compatibility.

## [3.3.7] - 2016-09-21
### Update
- Adds SVG as a supported file time for image compression.

## [3.3.6] - 2016-09-15
### Update
- Updates package gulp task to compile correctly and ignore `node_modules` & `bower_components` / Issue #77

## [3.3.5] - 2016-09-13
### Update
- Updates cssnano optimizations in `gulpfile.js`

## [3.3.4] - 2016-08-31
### Change
- Updates autoprefixer browser support / Issue #75

## [3.3.3] - 2016-08-18
### Added
- Hides empty paragraphs with p:empty style from @bebaps / Issue #74

## [3.3.2] - 2015-12-03
### Added
- Change log
- Touch detection based on Gist from @billerickson
