/*------------------------------------------------------------------------------
  Gulpfile.js
------------------------------------------------------------------------------*/
// Theme specific variables
var theme        = 'your-theme-name';
var phpFiles     = [];
var htmlFiles    = [];
var cssFiles     = ['src/assets/css/*.css', '!src/assets/css/*.min.css'];
var sassFiles    = ['src/assets/scss/theme.scss', 'src/assets/scss/**/*'];
var jsFiles      = ['src/assets/js/*.js', '!src/assets/js/theme.js', '!src/assets/js/theme.min.js'];
var imageFiles   = ['src/assets/img/*.{jpg,png,gif}'];
var concatFiles  = ['src/assets/js/theme.js'];
var copyFiles    = ['!src/assets/img/*', 'src/**/*'];

// Include gulp
var gulp         = require('gulp');

// Include plugins
var jshint       = require('gulp-jshint');
var sass         = require('gulp-sass');
var concat       = require('gulp-concat');
var uglify       = require('gulp-uglify');
var rename       = require('gulp-rename');
var imagemin     = require('gulp-imagemin');
var pngquant     = require('imagemin-pngquant');
var nano         = require('gulp-cssnano');
var sourcemaps   = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');
var zip          = require('gulp-zip');

/*------------------------------------------------------------------------------
  Development Tasks
------------------------------------------------------------------------------*/
// Lint Task
gulp.task('lint', function() {
  return gulp.src( jsFiles )
    .pipe(jshint())
    .pipe(jshint.reporter('default'));
});

// Compile Our Sass
gulp.task('sass', function() {
  return gulp.src( sassFiles )
    .pipe(sass())
    .pipe(autoprefixer({
      browsers: ['last 2 versions'],
      cascade: false
    }))
    .pipe(gulp.dest( 'src/assets/css' ));
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
      autoprefixer: false
    }))
    .pipe(gulp.dest( 'src/assets/css' ));
});

// Concatenate & Minify JS
gulp.task('scripts', ['lint'], function() {
  return gulp.src( jsFiles )
    .pipe(concat( concatFiles ))
    .pipe(gulp.dest('src/assets/js'))
    .pipe(rename('theme.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest( 'src/assets/js' ));
});

// Minimize Images
gulp.task('images', function() {
  return gulp.src( imageFiles )
  .pipe(imagemin({
    progressive: true,
    svgoPlugins: [{removeViewBox: false}],
    use: [pngquant()]
  }))
  .pipe(gulp.dest( 'src/assets/img' ));
});

// Copy Essential Files To Dist
gulp.task('copy', function() {
	gulp.src( copyFiles )
	.pipe(gulp.dest( theme ));
});

// Package a zip for theme upload
gulp.task('package', function() {
	return gulp.src( theme + '/**/*' )
		.pipe(zip( theme + '.zip' ))
		.pipe(gulp.dest( './' ));
});

// Styles Task - minify-css is the only task we call, because it is dependent upon sass running first.
gulp.task('styles', ['minify-css']);

/*------------------------------------------------------------------------------
  Default Tasks
------------------------------------------------------------------------------*/
// Default Task
gulp.task('default', ['styles', 'scripts', 'images', 'copy', 'watch']);

// Watch Files For Changes
gulp.task('watch', function() {
  gulp.watch([ jsFiles ], ['scripts']);
  gulp.watch( sassFiles, ['styles']);
  gulp.watch( cssFiles, ['styles']);
  gulp.watch( imageFiles, ['images']);
});
