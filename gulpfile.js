/*------------------------------------------------------------------------------
  Gulpfile.js
------------------------------------------------------------------------------*/
// Name your theme - this is outputted only when packaging your project.
var theme        = 'your-theme-name';

// Set the paths you will be working with
var phpFiles     = ['./**/*.php', './*.php'],
    htmlFiles    = ['./**/*.html', './*.html'],
    cssFiles     = ['./assets/css/*.css', '!./assets/css/*.min.css'],
    sassFiles    = ['./assets/scss/**/*.scss'],
    styleFiles   = [cssFiles, sassFiles],
    jsFiles      = ['./assets/js/theme.js'],
    imageFiles   = ['./assets/img/*.{jpg,png,gif,svg}'],
    concatFiles  = ['./assets/js/*.js', '!./assets/js/theme.min.js', '!./assets/js/all.js'],
    url          = 'wp-dev:8888'; // See https://browsersync.io/docs/options/#option-proxy

// Include gulp
var gulp         = require('gulp');

// Include plugins
var jshint       = require('gulp-jshint'),
    sass         = require('gulp-sass'),
    concat       = require('gulp-concat'),
    uglify       = require('gulp-uglify'),
    rename       = require('gulp-rename'),
    imagemin     = require('gulp-imagemin'),
    nano         = require('gulp-cssnano'),
    sourcemaps   = require('gulp-sourcemaps'),
    autoprefixer = require('gulp-autoprefixer'),
    browserSync  = require('browser-sync'),
    plumber      = require('gulp-plumber'),
    stylish      = require('jshint-stylish'),
    notify       = require('gulp-notify'),
    zip          = require('gulp-zip');

/*------------------------------------------------------------------------------
  Development Tasks
------------------------------------------------------------------------------*/
// Launch a development server
gulp.task( 'serve', function() {
  browserSync.init({
    proxy: url
      // port: 3000
  });
});

// Compile Sass
gulp.task('sass', function() {
  return gulp.src( sassFiles )
    .pipe(sourcemaps.init())
      .pipe(plumber())
      .pipe(sass({
        includePaths: [
          './node_modules/normalize-scss/sass/'
        ]
      })
        .on('error', sass.logError))
        .on('error', notify.onError("Error compiling SASS!")
      )
      .pipe(autoprefixer({
        browsers: ['last 3 versions', 'Safari > 7'],
        cascade: false
      }))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest( './assets/css' ))
    .pipe(browserSync.reload({
      stream: true
    }));
});

// Lint JavaScript
gulp.task('lint', function() {
  return gulp.src( jsFiles )
    .pipe(sourcemaps.init())
      .pipe(plumber())
      .pipe(jshint())
      .pipe(jshint.reporter(stylish))
      .pipe(jshint.reporter('fail'))
      .on('error', notify.onError({ message: 'Error compiling JavaScript!'}))
    .pipe(sourcemaps.write())
    .pipe(browserSync.reload({
      stream: true
    }));
});

/*------------------------------------------------------------------------------
  Production Tasks
------------------------------------------------------------------------------*/
// Minimize CSS
gulp.task('minify-css', ['sass'], function() {
	return gulp.src( cssFiles )
  	.pipe(rename({
      suffix: '.min'
    }))
    .pipe(nano({
      discardComments: {removeAll: true},
      autoprefixer: false,
      discardUnused: false,
      mergeIdents: false,
      reduceIdents: false,
      calc: {mediaQueries: true},
      zindex: false
    }))
    .pipe(gulp.dest( './assets/css' ))
    .pipe(browserSync.reload({
      stream: true
    }));
});

// Concatenate & Minify JavaScript
gulp.task('scripts', ['lint'], function() {
  return gulp.src( concatFiles )
    .pipe(concat( 'all.js' ))
    .pipe(gulp.dest( './assets/js/' ))
    .pipe(rename('theme.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest( './assets/js/' ));
});

// Compress Images
gulp.task('images', function() {
  return gulp.src( imageFiles )
  .pipe(plumber())
  .pipe(imagemin())
  .pipe(gulp.dest( './assets/img/' ));
});

// Package a zip for theme upload
gulp.task('package', function() {
  return gulp.src( [
    './**/*',
    '!bower_components',
    '!node_modules',
    '!bower_components/**',
    '!node_modules/**'
  ] )
		.pipe(zip( theme + '.zip' ))
		.pipe(gulp.dest( './' ));
});

// Build task to run all tasks and and package for distribution
gulp.task('build', ['sass', 'scripts', 'images', 'package']);

// Styles Task - minify-css is the only task we call, because it is dependent upon sass running first.
gulp.task('styles', ['minify-css']);

/*------------------------------------------------------------------------------
  Default Tasks
------------------------------------------------------------------------------*/
// Default Task
gulp.task('default', ['sass', 'scripts', 'serve', 'watch']);

// Watch Files For Changes
gulp.task('watch', function() {
  gulp.watch( sassFiles, ['styles']);
  gulp.watch( jsFiles, ['scripts']);
  gulp.watch( phpFiles, browserSync.reload );
  gulp.watch( htmlFiles, browserSync.reload );
});
