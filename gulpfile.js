const gulp = require('gulp');
const fileinclude = require('gulp-file-include');
const clean = require('gulp-clean');
const htmlmin = require('gulp-htmlmin');
const cleanCSS = require('gulp-clean-css');
const rename = require('gulp-rename');
const browserSync = require('browser-sync');

// --- ПЛАГИНЫ ДЛЯ SCSS ---
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('gulp-autoprefixer');

// --- ПЛАГИНЫ ДЛЯ JS ---
const terser = require('gulp-terser');  // ← ВМЕСТО gulp-uglify
const sourcemaps = require('gulp-sourcemaps');

// Пути к файлам
const paths = {
  src: 'src/**/*.html',
  htmlComponents: 'src/html/*.html',
  scss: 'src/assets/css/scss/style.scss',
  js: 'src/assets/js/**/*.js',
  img: 'src/assets/img/**/*',
  dist: 'dist/',
  theme: 'theme/'
};

// Очистка папок перед сборкой
function cleanDist() {
  return gulp.src([paths.dist, paths.theme + 'assets/css/', paths.theme + 'assets/js/'], { 
    read: false, 
    allowEmpty: true 
  })
  .pipe(clean());
}

// Сборка HTML
function html() {
  return gulp.src(['src/*.html', '!src/html/**/*'])
    .pipe(fileinclude({
      prefix: '@@',
      basepath: '@file'
    }))
    .pipe(htmlmin({ 
      collapseWhitespace: true, 
      removeComments: true,
      minifyJS: true,
      minifyCSS: true
    }))
    .pipe(gulp.dest(paths.dist))
    .pipe(browserSync.stream());
}

// Обработка SCSS в CSS
function styles() {
  return gulp.src(paths.scss)
    .pipe(sourcemaps.init())
    .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
    .pipe(autoprefixer({
      overrideBrowserslist: ['last 2 versions', '> 1%'],
      cascade: false
    }))
    .pipe(rename({ suffix: '.min' }))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(paths.theme + 'assets/css/'))
    .pipe(gulp.dest(paths.dist + 'assets/css/'))
    .pipe(browserSync.stream());
}

// Обработка JS с terser (поддерживает ES6+)
function scripts() {
  return gulp.src(paths.js)
    .pipe(sourcemaps.init())
    // ← terser поддерживает ES6+ без Babel!
    .pipe(terser({
      compress: {
        drop_console: false,
        drop_debugger: true,
        passes: 2  // ← двойной проход для лучшей минификации
      },
      output: {
        comments: false,
        beautify: false
      },
      mangle: {
        reserved: ['jQuery']  // ← защищаем jQuery от переименования
      }
    }))
    .on('error', function(err) {
      console.error('Terser error:', err.message);
      this.emit('end');
    })
    .pipe(rename({ suffix: '.min' }))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(paths.theme + 'assets/js/'))
    .pipe(gulp.dest(paths.dist + 'assets/js/'))
    .pipe(browserSync.stream());
}

// Копирование картинок
function images() {
  return gulp.src(paths.img)
    .pipe(gulp.dest(paths.dist + 'assets/img/'));
}

// Копирование картинок в тему
function themeImages() {
  return gulp.src(paths.img)
    .pipe(gulp.dest(paths.theme + 'assets/img/'));
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
  gulp.watch(paths.img, gulp.parallel(images, themeImages)).on('change', browserSync.reload);
}

// Таски
const build = gulp.series(
  cleanDist, 
  gulp.parallel(html, styles, scripts, images, themeImages)
);

const dev = gulp.series(build, gulp.parallel(watchFiles, serve));

exports.build = build;
exports.default = dev;

// Экспортируем отдельные таски
exports.styles = styles;
exports.scripts = scripts;
exports.images = images;
exports.themeImages = themeImages;