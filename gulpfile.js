"use strict";

require('dot-env').config();

const autoprefixer = require("gulp-autoprefixer");
const babel = require("gulp-babel");
const browserSync = require("browser-sync").create();
const cleanCSS = require("gulp-clean-css");
const colors = require("colors");
const del = require("del");
const eslint = require('gulp-eslint');
const mode = require("gulp-mode")();
const rename = require("gulp-rename");
const sass = require("gulp-sass");
const sourcemaps = require("gulp-sourcemaps");
const uglify = require("gulp-uglify");
const { series, src, dest, watch } = require("gulp");

sass.compiler = require("node-sass");

const NODE_ENV = process.env.NODE_ENV;
const URL = process.env.WP_URL;

// Project Paths 
const phpFiles = ['./**/*.php', './*.php'];
const cssFiles = './assets/css/';
const scssFiles = ['./assets/scss/**/*.scss'];
const jsEntry = './assets/js/src/theme.js';
const jsOutput = './assets/js/dist/';

// Theme Information 
const theme = "your-theme-name";
const version = "0.0.1"; // updated automatically - do not manually update

// Compile Sass
const sassTask = () => {
  return src(scssFiles)
    .pipe(sourcemaps.init())
    .pipe(sass().on("error", sass.logError))
    .pipe(
      autoprefixer({
        cascade: false
      })
    )
    .pipe(sourcemaps.write())
    .pipe(dest(cssFiles))
    .pipe(browserSync.stream());
};

// Minify CSS
const minifyCssTask = () => {
  return src(themeCssFile)
    .pipe(sourcemaps.init())
    .pipe(mode.production(cleanCSS()))
    .pipe(sourcemaps.write())
    .pipe(rename("theme.min.css"))
    .pipe(dest(cssFiles));
};

// Clean CSS folder
const cleanStyles = () => del(`${cssFiles}/**/*`);

// compile JS with Babel
const compile = () => {
  return src(jsEntry)
    .pipe(sourcemaps.init())
    .pipe(babel())
    .pipe(mode.production(uglify()))
    .pipe(sourcemaps.write())
    .pipe(dest(jsOutput));
};

const lintJs = () => {
  return src(jsEntry)
    .pipe(eslint())
    .pipe(eslint.format())
    .pipe(eslint.failAfterError())
}

// clean js dist folder
const cleanJs = () => del(`${jsOutput}/**/*`);

// browser sync server
const server = () => {
  console.log(colors.green.bold(`🛠  Running in ${NODE_ENV} mode`)); // eslint-disable-line no-console
  browserSync.init({
    proxy: URL ? URL : 'http://localhost:3000'
  });

  watch(scssFiles, series(cleanStyles, sassTask, minifyCssTask));
  watch(jsEntry, series(lintJs, compile, browserSync.reload));
  watch(phpFiles).on("change", browserSync.reload);
};

module.exports = {
  "minify-css": minifyCssTask,
  build: series(cleanStyles, cleanJs, sassTask, minifyCssTask, lintJs, compile),
  clean: series(cleanStyles, cleanJs),
  compile: series(cleanJs, lintJs, compile),
  serve: series(cleanStyles, cleanJs, sassTask, minifyCssTask, lintJs, compile, server),
  styles: series(cleanStyles, sassTask, minifyCssTask)
};