# Gulp Tasks
Prelude gives you most of the gulp tasks you'll need to successfully develop and
deploy a WordPress theme.

## List of Gulp Tasks
Below are a list of the default gulp tasks.
- `gulp serve` - creates a local development server with live reloading and CSS injection via [Browsersync](https://www.browsersync.io/docs/)
- `gulp sass` - compiles Sass/SCSS files into CSS, adds vendor prefixes, and creates a sourcemap
- `gulp minify-css` - ensures all Sass/SCSS is compiled to CSS (runs `gulp sass` before running itself) and minifies them
- `gulp styles` - runs the `sass` and `minify-css` tasks, in that order
- `gulp lint` - a JavaScript helper to find and catch errors with [ESLint](https://eslint.org/)
- `gulp scripts` - concatenates and minifies JS files (in the order you declare via the [`concatFiles` array](gulpfile-customization.md))
- `gulp images` - compresses images in as defined in the [`imageFiles` array](gulpfile-customization.md)
- `gulp watch` - watches files for changes and runs tasks based on what file changes
- `gulp version` - updates WordPress theme version by passing one of three flags, `--major, --minor, --patch`. Alternatively you can also check version by passing no flags to the task.
- `gulp package` - creates a production ready `.zip` file based on your production theme folder
- `gulp build` - runs all tasks except `serve` and `watch`

Running `gulp` or `gulp default` will run all tasks except `package`.
