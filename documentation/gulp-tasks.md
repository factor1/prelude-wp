# Gulp Tasks

Prelude uses gulp to run browsersync and compress images for production. You most likely will not need to run these directly.

## List of Gulp Tasks

Below are a list of the default gulp tasks.

- `gulp build` - runs all build related tasks that are executed with Gulp. (functions in series: `compressImages`).
- `gulp serve` - creates a local development server with live reloading and CSS injection via [Browsersync](https://www.browsersync.io/docs/). Also runs a series of gulp functions to compile your theme files/assets.
