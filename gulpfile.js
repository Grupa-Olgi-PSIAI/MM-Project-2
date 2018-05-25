const gulp = require('gulp');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const less = require('gulp-less');
const path = require('path');
const cssmin = require('gulp-cssmin');
const rename = require('gulp-rename');
const del = require('del');

const resourcesDir = './src/MMProjectBundle/Resources/';
const publicDir = './web/';

gulp.task('less', function () {
    return gulp.src(resourcesDir + 'views/less/**/*.less')
        .pipe(less({
            paths: [path.join(__dirname, 'less', 'includes')]
        }))
        .pipe(gulp.dest(publicDir + 'css'));
});

gulp.task('minjs', function () {
    return gulp.src(publicDir + 'js/*.js')
        .pipe(concat('min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(publicDir + 'dist/'))
});

gulp.task('mincss', function () {
    return gulp.src(publicDir + 'css/*.css')
        .pipe(cssmin())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(publicDir + 'dist/'));
});

gulp.task('clean', function () {
    return del([publicDir + 'css'])
});

gulp.task('default',
    gulp.series('less',
        gulp.series(gulp.parallel('minjs', 'mincss'),
            'clean'
        )
    )
);
