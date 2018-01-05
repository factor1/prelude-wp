# Gulpfile Customization
The gulpfile is the lifeblood of Prelude. It runs most of the tasks that your
theme will be dependent upon. There are a few variables and tweaks you can make
to it to better suite your needs.

## Development/BrowserSync URL
Prelude uses [BrowserSync](https://www.browsersync.io/) to allow for a great coding experience. It provides
the ability to see your work instantly in the browser without the need to refresh.
It should work out of the box by simply updating the `url` variable in `gulpfile.js`
with your local development URL. ([See Browsersync + Gulp.js Documentation](https://www.browsersync.io/docs/gulp)
for more options)

## File Paths
We set some variables to common file paths so that we can reference them
multiple times throughout the gulpfile.

**List of default variables:**
- `phpFiles`
- `htmlFiles`
- `cssFiles`
- `sassFiles`
- `styleFiles`
- `jsFiles`
- `imageFiles`
- `concatFiles`

For the most part, you won't need to modify these with the exception of
`concatFiles`, which can be updated to include JavaScript files from directories
such as `node_modules` or `bower_components`.

## Sass Paths
When working with sass that may live in a package manager, you will need to include
those paths so that when any gulp tasks that run sass know where to look. By
default, there is already one sass path that you can use as an example:

```js
.pipe(sass({
  includePaths: [
    './node_modules/normalize-scss/sass/'
  ]
})
```
Let's say that you add [Ginger Grid](https://gingergrid.com) via npm, including
the sass files from its package would look something like this:

```js
.pipe(sass({
  includePaths: [
    './node_modules/normalize-scss/sass/',
    './node_modules/ginger-grid/'
  ]
})
```

Now when trying to use `@import ginger` sass will check that path for the relevant
sass file to import and it will be included in your compiled styles.
