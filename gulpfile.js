var gulp    = require('gulp'),
    babel   = require("gulp-babel"),
    concat  = require('gulp-concat'),
    clean   = require('gulp-clean'),
    uglify  = require('gulp-uglify');

gulp.task('clean', function () {
    return gulp.src('src/MainBundle/Resources/public/js/compiled', {read: false})
        .pipe(clean());
});

gulp.task('babel', ['clean'], function () {
    return gulp.src(["src/MainBundle/Resources/public/js/angular/app.js", "src/MainBundle/Resources/public/js/angular/**/*.js"])
        .pipe(babel())
        .pipe(gulp.dest("src/MainBundle/Resources/public/js/compiled"));
});

gulp.task('merge', ['babel'], function () {
    return gulp.src([
        'src/MainBundle/Resources/public/js/compiled/**/*.js'
    ])
        .pipe(concat('angular-compiled.js'))
        .pipe(gulp.dest('web/js/compiled'));
});

gulp.task('compress', ['merge'], function () {
    return gulp.src('web/js/compiled/angular-compiled.js')
        .pipe(uglify())
        .pipe(gulp.dest('web/js/compiled'));
});

gulp.task("default", ['merge']);