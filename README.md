# Prelude #

Prelude is a Wordpress starter theme that helps you craft custom themes. It uses
Gulp to compile and minify scss/css, concatenate and minify JS, compress images,
and more.

## Features ##

### Gulp Tasks ###
<<<<<<< HEAD
Prelude uses Gulp to: 
=======
Prelude uses Gulp to:
>>>>>>> develop
* Compile & minify Sass/CSS
* Auto-prefix your Sass/CSS
* Minify and concatenate JavaScript/jQuery
* Compress PNG & JPGs
* Create a theme distribution folder for local testing
* Package a theme for upload to Wordpress

### Wordpress Functions ###
Prelude has some nifty features built into `functions.php` to make developing a custom Wordpress theme a little easier.
* Shortcode Maker - allows for easy creation of custom shortcodes. Useful for buttons or custom media embeds.
* Defer jQuery Parsing using the HTML5 defer property
* Customize Wordpress Admin Login / Admin Footer Text
* Customized Read More Links
* Other various improvements to default Wordpress functions that are too long and/or small to list here

## Getting Started ##
Prelude requires that you have Node and npm installed on your machine. If you need help with that, please visit the [npm documentation](https://docs.npmjs.com/getting-started/installing-node).

1. Clone this repository to your machine, or download the .zip and place its contents in your project folder
2. Install from the project folder using `npm install`
3. Using the `theme` variable found in `gulpfile.js` name your theme (Don't forget to also fill out the theme information found in `style.css` in the root of `src/`)
4. Run the default Gulp task while editing files using `gulp` or `gulp default`

When running the default gulp task, a theme folder will be created based on the `theme` variable. You can use this folder as your theme when running locally. When you're ready to package your theme you can run `gulp package` to create a zip folder of your production theme.

## File Structure ##
You can modify the file structure however you like as long as it is also updated in `gulpfile.js`. Of course your project files may vary. By default it is as follows:

```
.
├── README.md
├── gulpfile.js
├── package.json
└── src
    ├── 404.php
    ├── archive.php
    ├── comments.php
    ├── footer.php
    ├── functions.php
    ├── header.php
    ├── images
    │	├── src
    ├── inc
    │   ├── meta.php
    │   └── nav.php
    ├── index.php
    ├── page.php
    ├── screenshot.png
    ├── scss
    │   ├── components
    │   │   ├── _footer.scss
    │   │   ├── _header.scss
    │   ├── global
    │   │   └── _global.scss
    │   │   └── _typography.scss
    │   ├── page-templates
    │   ├── settings
    │   │   └── _variables.scss
    │   ├── theme.scss
    │   └── vendor
    ├── search.php
    ├── searchform.php
    ├── shortcode_maker.php
    ├── shortcodes
    │   ├── _instructions.php
    │   ├── col_end.php
    │   ├── col_start.instructions
    │   ├── col_start.php
    │   ├── fluidvideo.php
    │   ├── fluidvideo.instructions
    │   ├── row_end.php
    │   └── row_start.php
    ├── sidebar.php
    ├── single.php
    └── style.css
```

As mentioned in the getting started section, when the default Gulp task is ran, a theme folder will be created in the project root folder. Default compile paths are as follows:

* `src/images/src` compresses images and moves them up a level to `images`
* `src/scss/theme.scss` compiles to `src/css/theme.css`
* `src/css/` all css files are minified in place, with a suffix of `.min.css`. Files that are already minified will be ignored.  
* `src/js/*.js` is concatenated and added to `global.js` then minified to `global.min.js`

## List Of Gulp Tasks ##
There are 8 Gulp tasks available by default.

* `gulp lint` - a Javascript helper to find and catch errors
* `gulp sass` - compiles sass files and auto-prefixes the styles
* `gulp minify-css` - minifies css files but first runs `sass`.
* `gulp styles` - runs `sass` and then `minify-css`, in that order.
* `gulp scripts` - concatenates and minifies JS files
* `gulp images` - compresses images
* `gulp copy` - copies files from `src/` to the theme folder as named in `gulpfile.js` (This task only copies production files and leaves behind uncompiled/uncompressed files)
* `gulp watch` - watches folder and files for changes and runs tasks based on what was updated
* `gulp package` - creates a production ready `.zip` file based on your production theme folder

Running `gulp` or `gulp default` will run all tasks except `package`.

## Bugs, Contributions & Questions ##
We are always looking for ways to improve. If you find a bug, have a question, or wish to add a contribution please open an issue.
