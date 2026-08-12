const gulp = require('gulp');
const fileinclude = require('gulp-file-include');
const clean = require('gulp-clean');
const htmlmin = require('gulp-htmlmin');
const cleanCSS = require('gulp-clean-css');
const rename = require('gulp-rename');
const browserSync = require('browser-sync');

// --- ПЛАГИНЫ ДЛЯ SCSS ---
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('gulp-autoprefixer'); // Обычный require

// Пути к файлам
const paths = {
  src: 'src/**/*.html',
  htmlComponents: 'src/html/*.html',
  scss: 'src/assets/css/scss/style.scss',
  js: 'src/assets/js/**/*.js',
  img: 'src/assets/img/**/*',
  dist: 'dist/'
};

// Очистка папки dist перед сборкой
function cleanDist() {
  return gulp.src(paths.dist, { read: false, allowEmpty: true })
    .pipe(clean());
}

// Сборка HTML
function html() {
  return gulp.src(['src/*.html', '!src/html/**/*'])
    .pipe(fileinclude({
      prefix: '@@',
      basepath: '@file'
    }))
    .pipe(htmlmin({ collapseWhitespace: true, removeComments: true }))
    .pipe(gulp.dest(paths.dist))
    .pipe(browserSync.stream());
}

// Обработка SCSS в CSS
function styles() {
  return gulp.src(paths.scss)
    .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
    .pipe(autoprefixer({
      overrideBrowserslist: ['last 2 versions', '> 1%'],
      cascade: false
    }))
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest(paths.dist + 'assets/css/'))
    .pipe(browserSync.stream());
}

// Копирование JS
function scripts() {
  return gulp.src(paths.js)
    .pipe(gulp.dest(paths.dist + 'assets/js/'))
    .pipe(browserSync.stream());
}

// Копирование картинок и видео
function images() {
  return gulp.src(paths.img)
    .pipe(gulp.dest(paths.dist + 'assets/img/'));
}

// Запуск сервера
function serve(done) {
  browserSync.init({
    server: {
      baseDir: paths.dist
    },
    port: 3000,
    open: true,
    notify: false
  });
  done();
}

// Слежка за изменениями
function watchFiles() {
  gulp.watch(['src/*.html', 'src/html/**/*.html'], html);
  gulp.watch('src/assets/css/scss/**/*.scss', styles);
  gulp.watch(paths.js, scripts);
  gulp.watch(paths.img, images).on('change', browserSync.reload);
}

// Таски
const build = gulp.series(cleanDist, gulp.parallel(html, styles, scripts, images));
const dev = gulp.series(build, gulp.parallel(watchFiles, serve));

exports.build = build;
exports.default = dev;