// Theme Specific Variables
var theme = 'your-theme-name';

// Include gulp
var gulp = require('gulp');

// Include Our Plugins
var jshint = require('gulp-jshint');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var imagemin = require('gulp-imagemin');
var pngquant = require('imagemin-pngquant');
var minifyCss = require('gulp-cssnano');
// var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');
var zip = require('gulp-zip');

// Lint Task
gulp.task('lint', function() {
    return gulp.src([
    	'src/js/*.js',
    	'!src/js/global.js',
    	'!src/js/global.min.js'
    	])
        .pipe(jshint())
        .pipe(jshint.reporter('default'));
});

// Compile Our Sass
gulp.task('sass', function() {
    return gulp.src('src/scss/theme.scss')
        .pipe(sass())
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe(gulp.dest('src/css/'));
});

// Minimize CSS
gulp.task('minify-css', ['sass'], function() {
  	return gulp.src([
  		'src/css/*.css',
  		'!src/css/*.min.css'
  		])
	  	.pipe(rename({
		        suffix: '.min'
	        }))
	    .pipe(nano())
	    .pipe(gulp.dest('src/css/'));
});

// Concatenate & Minify JS
gulp.task('scripts', function() {
    return gulp.src([
    	'src/js/*.js',
    	'!src/js/global.js',
    	'!src/js/global.min.js'
    	])
        .pipe(concat('global.js'))
        .pipe(gulp.dest('src/js'))
        .pipe(rename('global.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('src/js'));
});

// Minimize Images
gulp.task('images', function() {
    return gulp.src('src/images/src/*.{jpg,png}')
    .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngquant()]
        }))
    .pipe(gulp.dest('src/images'));
});

// Copy Essential Files To Dist
gulp.task('copy', function() {
	gulp.src([
		// set up what you want to copy or ignore
		'!src/images/src/*',
		'src/**/*'
	])
	.pipe(gulp.dest(theme));
});

// Watch Files For Changes
gulp.task('watch', function() {
    gulp.watch([
    	'src/js/*.js',
    	'!src/js/global.js',
    	'!src/js/global.min.js'
    	], ['lint', 'scripts']);
    gulp.watch('src/scss/**/*.scss', ['styles']);
    gulp.watch('src/css/*.css', ['styles']);
    gulp.watch('src/images/src/*.{jpg,png}', ['images']);
});

// Package a zip for theme upload
gulp.task('package', function() {
	return gulp.src(theme+'/**/*')
		.pipe(zip(theme+'.zip'))
		.pipe(gulp.dest('./'));
});

// Styles Task - minify-css is the only task we call, because it is dependent upon sass running first.
gulp.task('styles', ['minify-css']);

// Default Task
gulp.task('default', ['lint', 'styles', 'scripts', 'images', 'copy', 'watch']);
