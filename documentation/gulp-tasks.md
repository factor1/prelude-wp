# Gulp Tasks
Prelude gives you most of the gulp tasks you'll need to successfully develop and
deploy a WordPress theme.

## List of Gulp Tasks
Below are a list of the default gulp tasks.
- `gulp minify-css` - minifies css files
- `gulp build` - runs all build related tasks. (functions in series: `cleanStyles`, `cleanJs`, `compressImages`, `sassTask`, `minifyCssTask`, `lintJs`, `compile`). This runs everything you need to make your theme production ready.
- `gulp clean` - cleans all distribution files
- `gulp compile` - compiles javascript using babel as well as cleans and lints javascript.
- `gulp serve` - creates a local development server with live reloading and CSS injection via [Browsersync](https://www.browsersync.io/docs/). Also runs a series of gulp functions to compile your theme files/assets.
- `gulp styles` - handles all css/scss functions and compiling
- `gulp sassTask` - specifically only runs the sass compilation.

