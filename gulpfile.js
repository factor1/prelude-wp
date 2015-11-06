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
var minifyCss = require('gulp-minify-css');

// Lint Task
gulp.task('lint', function() {
    return gulp.src('src/js/*.js')
        .pipe(jshint())
        .pipe(jshint.reporter('default'));
});

// Compile Our Sass
gulp.task('sass', function() {
    return gulp.src('src/scss/theme.scss')
        .pipe(sass())
        .pipe(gulp.dest('src/css/'));
});

// Minimize CSS
gulp.task('minify-css', function() {
  	return gulp.src([
  		'src/css/*.css',
  		'!src/css/*.min.css'
  	])
	  	.pipe(rename({
		        suffix: '.min'
	        }))
	    .pipe(minifyCss({
		    compatibility: 'ie8',
		    aggressiveMerging: false,
		    processImport: true
		    }))
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
		'!src/scss',
		'!src/scss/**/*',
		'!src/images/src/*',
		'src/**/*'
	])
	.pipe(gulp.dest(theme));
});

// Watch Files For Changes
gulp.task('watch', function() {
    gulp.watch('src/js/*.js', ['lint', 'scripts']);
    gulp.watch('src/scss/*.scss', ['sass']);
    gulp.watch('src/css/*.css', ['minify-css']);
    gulp.watch('src/images/src/*.{jpg,png}', ['images']);
});

// Default Task
gulp.task('default', ['lint', 'sass', 'minify-css', 'scripts', 'images', 'copy', 'watch']);