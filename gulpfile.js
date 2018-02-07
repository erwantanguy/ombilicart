var browserify = require('browserify');
var gulp = require('gulp');
var source = require('vinyl-source-stream');
var uglify = require('gulp-uglify');
var buffer = require('vinyl-buffer');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
//var fancybox = require('jquery-fancybox');

// Browserify
gulp.task('browserify', function () {
  return browserify('./js/app.js')
    .bundle()
    .pipe(source('bundle.js'))
    .pipe(buffer())
    .pipe(uglify())
    .pipe(gulp.dest(''));
});

// Sass

//node_modules/bootstrap/dist/css/bootstrap.css
gulp.task('styles', function () {
  return gulp.src('./assets/sass/app.scss')
    .pipe(sass({outputStyle: 'compressed', includePaths: ['./node_modules/bootstrap-sass/assets/stylesheets']}))
    .pipe(autoprefixer('last 2 version', 'ie 8', 'ie 9'))
    .pipe(gulp.dest(''));
});

// Watch
gulp.task('watch', function () {
  gulp.watch(['./js/**/*.js'], ['browserify']);
  gulp.watch(['./assets/sass/**/*.scss'], ['styles']);
  return;
});

// The default task (called when you run `gulp` from cli)
gulp.task('default', [
  'browserify',
  'styles',
  'watch'
]);