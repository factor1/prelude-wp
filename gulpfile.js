/*------------------------------------------------------------------------------
  Gulpfile.js
------------------------------------------------------------------------------*/
// Name your theme - this should match the theme folder name
var theme        = 'your-theme-name';

// Set the paths you will be working with
var phpFiles     = [theme + '/**/*.php'],
    htmlFiles    = [theme + '/**/*.html'],
    cssFiles     = [theme + '/assets/css/*.css', '!' +theme + '/assets/css/*.min.css'],
    cssDest      = [theme + '/assets/css'],
    sassFiles    = [theme + '/assets/scss/**/*.scss'],
    styleFiles   = [cssFiles, sassFiles],
    jsFiles      = [theme + '/assets/js/theme.js'],
    jsDest       = [theme + '/assets/js'],
    imageFiles   = [theme + '/assets/img/*.{jpg,png,gif}'],
    imageDest    = [theme + '/assets/img'],
    concatFiles  = [theme + '/assets/js/*.js', '!' + theme + '/assets/js/theme.min.js', '!' + theme + '/assets/js/all.js'],
    url          = 'your-local-virtual-host'; // See https://browsersync.io/docs/options/#option-proxy

// Include gulp
var gulp         = require('gulp');

// Include plugins
var jshint       = require('gulp-jshint'),
    sass         = require('gulp-sass'),
    concat       = require('gulp-concat'),
    uglify       = require('gulp-uglify'),
    rename       = require('gulp-rename'),
    imagemin     = require('gulp-imagemin'),
    pngquant     = require('imagemin-pngquant'),
    nano         = require('gulp-cssnano'),
    sourcemaps   = require('gulp-sourcemaps'),
    autoprefixer = require('gulp-autoprefixer'),
    browserSync  = require('browser-sync'),
    plumber      = require('gulp-plumber'),
    stylish      = require('jshint-stylish');
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
      .pipe(sass())
      .pipe(autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
      }))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest( 'src/assets/css' ))
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
      autoprefixer: false
    }))
    .pipe(gulp.dest( cssDest ))
    .pipe(browserSync.reload({
      stream: true
    }));
});

// Concatenate & Minify JavaScript
gulp.task('scripts', ['lint'], function() {
  return gulp.src( concatFiles )
    .pipe(concat( 'all.js' ))
    .pipe(gulp.dest( jsDest ))
    .pipe(rename('theme.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest( jsDest ));
});

// Compress Images
gulp.task('images', function() {
  return gulp.src( imageFiles )
  .pipe(plumber())
  .pipe(imagemin({
    progressive: true,
    interlaced: true,
    svgoPlugins: [{removeViewBox: false}],
    use: [pngquant()]
  }))
  .pipe(gulp.dest( imageDest ));
});

// Package a zip for theme upload
gulp.task('package', function() {
	return gulp.src( theme + '/**/*' )
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
gulp.task('default', ['sass', 'scripts', 'images', 'serve', 'watch']);

// Watch Files For Changes
gulp.task('watch', function() {
  gulp.watch( styleFiles, ['styles']);
  gulp.watch( jsFiles, ['scripts']);
  gulp.watch( imageFiles, ['images'], browserSync.reload );
  gulp.watch( phpFiles, browserSync.reload );
  gulp.watch( htmlFiles, browserSync.reload );
});

gulp.task('test', function(){
  console.log(phpFiles);
});
