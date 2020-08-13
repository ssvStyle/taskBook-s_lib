var gulp = require('gulp'),
    postcss = require('gulp-postcss'),
    autoprefixer = require('autoprefixer'),
    rigger = require('gulp-rigger');

gulp.task('myHtml', function () {
    return gulp.src('src/*.html')
        .pipe(rigger())
        .pipe(gulp.dest('app'));
});

gulp.task('myCss', function () {
    return gulp.src('src/css/style.css')
        .pipe(postcss([autoprefixer]) )
        .pipe(gulp.dest('app/css'));
});

gulp.task('js', function () {
    return gulp.src('src/js/*')
        .pipe(gulp.dest('app/js'));
});

gulp.task('myImages', function () {
    return gulp.src('src/images/*/*')
        .pipe(gulp.dest('app/images'));
});

gulp.task('myFinalBuild', gulp.series(['myHtml', 'myCss', 'myImages', 'js']));
