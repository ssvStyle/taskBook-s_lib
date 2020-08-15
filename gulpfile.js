var gulp = require('gulp'),
    postcss = require('gulp-postcss'),
    autoprefixer = require('autoprefixer'),
    cleanCSS = require('gulp-clean-css'),
    sass = require('gulp-sass'),
    rigger = require('gulp-rigger');

gulp.task('html', function () {
    return gulp.src('src/templates/**/*.html')
        .pipe(rigger())
        .pipe(gulp.dest('templates'));
});

gulp.task('style', function () {
    return gulp.src('src/scss/style.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss([autoprefixer]))
        .pipe(cleanCSS())
        .pipe(gulp.dest('public/css'));
});

gulp.task('js', function () {
    return gulp.src('src/js/**/*.js')
        .pipe(gulp.dest('public/js'));
});

gulp.task('img', function () {
    return gulp.src('src/img/**/*')
        .pipe(gulp.dest('public/img'));
});

gulp.task('build', gulp.series(['html', 'style', 'img', 'js']));
