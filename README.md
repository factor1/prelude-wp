# Prelude
Prelude is a WordPress starter theme that helps you craft custom themes. It uses Gulp to compile and minify scss/css, concatenate and minify JS, compress images, and more.

## Features
### Gulp Tasks
Prelude uses Gulp to:
- Compile & minify Sass/CSS with sourcemaps
- Auto-prefix your Sass/CSS
- Minify and concatenate JavaScript/jQuery
- Compress images
- Package a theme for upload to WordPress or distribution

### WordPress Functions
Prelude has some nifty features built into `functions.php` to make developing a custom WordPress theme a little easier.
- Defer jQuery Parsing using the HTML5 defer property
- Customized Read More Links
- [Get Featured image as URL](https://github.com/factor1/prelude-wp/wiki/Get-Featured-Image-As-URL)
- Other various improvements to default WordPress functions that are too long and/or small to list here, check 'em out!

## Getting Started
Prelude requires that you have Node and npm installed on your machine. If you need help with that, please visit the [npm documentation](https://docs.npmjs.com/getting-started/installing-node).

1. Install Prelude into your project using `npm install prelude-wp --save` and copy all theme files to your root directory. **NOTE: As of `3.3.9` Prelude no longer automatically moves theme files into your root directory.**
2. Using the `theme` variable found in `gulpfile.js` name your theme. This is only used for packaging purposes and is not critical (Don't forget to also fill out the theme information found in `style.css` in the root)
3. Run the default Gulp task while editing files using `gulp` or `gulp default`


## File Structure
You can modify the file structure however you like as long as it is also updated in `gulpfile.js`. Of course your project files may vary. By default it is as follows:

```
.
├── .editorconfig
├── .gitignore
├── .jshintrc
├── 404.php
├── CHANGELOG.md
├── README.md
├── archive.php
├── /assets
|  ├── /js
|  |  └── theme.js
|  └── /scss
|     ├── /components
|     |  ├── _footer.scss
|     |  ├── _header.scss
|     |  └── _social-menu.scss
|     ├── /globals
|     |  ├── _global.scss
|     |  ├── _typography.scss
|     |  └── _wordpress.scss
|     ├── /mixins
|     |  └── _sugar.scss
|     ├── /plugins
|     |  └── _overrides.scss
|     ├── /settings
|     |  └── _variables.scss
|     └── theme.scss
├── footer.php
├── functions.php
├── gulpfile.js
├── header.php
├── /inc
|  ├── custom-post-types.php
|  ├── enqueues.php
|  ├── menus.php
|  ├── shortcodes.php
|  ├── thumbnails.php
|  ├── tweaks.php
|  └── widgets.php
├── index.php
├── package.json
├── page.php
├── /parts
|  ├── meta.php
|  └── post-nav.php
├── screenshot.png
├── search.php
├── sidebar.php
├── single.php
└── style.css
```

## Setting your default compile paths in Gulp
We have created variables to hold an array of your desired paths. This makes it so that you only need to update paths in one location. These variables are then passed into the Gulp tasks for processing.

The variables are:
- `phpFiles` - accepts an array of .php files
- `htmlFiles` - accepts an array of .html files
- `cssFiles` - accepts an array of .css file
- `sassFiles` - accepts an array of .scss/.sass files
- `styleFiles` - uses both `cssFiles` & `sassFiles` paths for watching purposes (avoids loop issues)
- `jsFiles` - accepts an array of .js files
- `imageFiles` - accepts an array of image files (.jpg, .png, .gif, etc)
- `concatFiles` - accepts an array of .js files. These are used to concatenate your .js files into one file, and as such the files must be listed in the order you desire
- `copyFiles` - accepts an array of files
- `url` - accepts a string to use as the BrowserSync proxy

## List Of Gulp Tasks
Below are a list of the default gulp tasks.
- `gulp serve` - creates a local development server with live reloading and CSS injection via [BrowserSync](https://www.browsersync.io/docs/)
- `gulp sass` - compiles Sass/SCSS files into CSS, adds vendor prefixes, and creates a sourcemap
- `gulp minify-css` - ensures all Sass/SCSS is compiled to CSS and minifies them
- `gulp styles` - runs the `sass` and `minify-css` tasks, in that order
- `gulp lint` - a JavaScript helper to find and catch errors, and creates a sourcemap
- `gulp scripts` - concatenates and minifies JS files (in the order you declare)
- `gulp images` - compresses images
- `gulp watch` - watches files for changes and runs tasks based on what was updated
- `gulp version` - updates WordPress theme version by passing one of three flags, `--major, --minor, --patch`. Alternatively you can also check version by passing no flags to the task.
- `gulp package` - creates a production ready `.zip` file based on your production theme folder
- `gulp build` - runs all tasks except `serve` and `watch`

Running `gulp` or `gulp default` will run all tasks except `package`.

## Bugs, Contributions & Questions
We are always looking for ways to improve. If you find a bug, have a question, or wish to add a contribution please open an issue.
