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
    return gulp.src('js/*.js')
        .pipe(jshint())
        .pipe(jshint.reporter('default'));
});

// Compile Our Sass
gulp.task('sass', function() {
    return gulp.src('scss/theme.scss')
        .pipe(sass())
        .pipe(gulp.dest('css/'));
});

// Minimize CSS
gulp.task('minify-css', function() {
  	return gulp.src('css/*.css')
	  	.pipe(rename({
		        suffix: '.min'
	        }))
	    .pipe(minifyCss({
		    compatibility: 'ie8',
		    aggressiveMerging: false,
		    processImport: true
		    }))
	    .pipe(gulp.dest('css/'));
});

// Concatenate & Minify JS
gulp.task('scripts', function() {
    return gulp.src([
    	'js/*.js'
    	])
        .pipe(concat('global.js'))
        .pipe(gulp.dest('js'))
        .pipe(rename('global.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('js'));
});

// Minimize Images
gulp.task('images', function() {
    return gulp.src('images/src/*.{jpg,png}')
    .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngquant()]
        }))
    .pipe(gulp.dest('images'));
});

// Copy Essential Files To Dist
gulp.task('copy', function() {
	gulp.src([
		// set up what you want to copy or ignore
		'!scss/',
		'!node_modules/',
		'!bower_components',
		'./**/*'
	])
	.pipe(gulp.dest('../dist/'));
});

// Watch Files For Changes
gulp.task('watch', function() {
    gulp.watch('js/*.js', ['lint', 'scripts']);
    gulp.watch('sass/*.scss', ['sass']);
    gulp.watch('css/*.css', ['minify-css']);
    gulp.watch('images/src/*.{jpg,png}', ['images']);
});

// Default Task
gulp.task('default', ['lint', 'sass', 'minify-css', 'scripts', 'images', 'copy', 'watch']);