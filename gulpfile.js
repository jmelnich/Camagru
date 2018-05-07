var gulp = require('gulp');
var scss = require('gulp-sass'); //name your var however you want but require the same name that in package.json file
var browserSync = require('browser-sync');
var imageMin = require('gulp-imagemin');
var cssMin = require('gulp-clean-css');
var rename = require('gulp-rename');
var php = require('gulp-connect-php');
//TODO: add minifier (gulp-concat FOR JS)
gulp.task('sass', function(){ //name my task whatever I like
    return gulp.src(['raw/sass/style.scss']) //source from where I take these files
    .pipe(scss()) //how I declared it when required it
    .pipe(gulp.dest('pro/css')) //destination where I put its files
    .pipe(browserSync.reload({stream: true}))
    })

gulp.task('imageMin', function(){
    return gulp.src('raw/img/*')
    .pipe(imageMin())
    .pipe(gulp.dest('pro/img'))
    .pipe(browserSync.reload({stream: true}))
    })

gulp.task('minify-css', function(){
    return gulp.src('pro/css/*')
    .pipe(cssMin())
    .pipe(rename({
            suffix: '.min'
        }))
    .pipe(gulp.dest('pro/mincss'))
    .pipe(browserSync.reload({stream: true}))
    })

gulp.task('php', function() {
    php.server({
        base: "./", port: 8010, keepalive: true
    });
})

gulp.task('browser-sync', ['php'], function(){
    browserSync({
        proxy: '127.0.0.1:8010',
        port: 8080,
        open: true,
        notify: false
        })
    })


gulp.task('watch', ['browser-sync', 'php', 'sass', 'imageMin', 'minify-css'], function(){ //all tasks I launch before watch task
    // files I listen to in the watch process
    gulp.watch('raw/sass/*.scss', ['sass']);
    gulp.watch('pro/css/*', ['minify-css']);
    gulp.watch('pro/css/*', browserSync.reload);
    gulp.watch('./*.html', browserSync.reload);
    gulp.watch('./*.php', browserSync.reload);
    gulp.watch('raw/js/*.js', browserSync.reload);
    //TODO: add watch after minifier (gulp-concat FOR JS)
    })