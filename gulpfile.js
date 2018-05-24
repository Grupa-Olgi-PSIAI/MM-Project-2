const gulp = require('gulp');
const minify = require('gulp-minify');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const less = require('gulp-less');
const path = require('path');
const cssmin = require('gulp-cssmin');
const rename = require('gulp-rename');

const resDir = './web/';

gulp.task('less', function () {
    return gulp.src(resDir + 'less/**/*.less')
        .pipe(less({
            paths: [path.join(__dirname, 'less', 'includes')]
        }))
        .pipe(gulp.dest(resDir + 'css'));
});

gulp.task('minjs', function () {
    return gulp.src(resDir + 'js/*.js')
        .pipe(concat('min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(resDir + 'dist/'))
});

gulp.task('mincss', function () {
    return gulp.src(resDir + 'css/*.css')
        .pipe(cssmin())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(resDir + 'dist/'));
});

gulp.task('default', gulp.series('less', 'minjs', 'mincss'));
