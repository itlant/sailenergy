const gulp = require('gulp');
const fileInclude = require('gulp-file-include');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const cleanCSS = require('gulp-clean-css');
const rename = require('gulp-rename');
const sourcemaps = require('gulp-sourcemaps');
const imagemin = require('gulp-imagemin');
const webp = require('gulp-webp');
const htmlmin = require('gulp-htmlmin');
const plumber = require('gulp-plumber');
const notify = require('gulp-notify');
const autoprefixer = require('gulp-autoprefixer');
const del = require('del');

// Пути к файлам
const paths = {
  src: {
    html: 'src/*.html',
    htmlIncludes: 'src/html/**/*.html',
    css: 'src/css/**/*.css',
    js: 'src/js/**/*.js',
    images: 'src/img/**/*.{jpg,jpeg,png,gif,svg,ico,webp}',
    fonts: 'src/fonts/**/*',
    favicon: 'src/img/fovicon/**/*'
  },
  dist: {
    root: 'dist',
    css: 'dist/assets/css',
    js: 'dist/assets/js',
    images: 'dist/assets/img',
    fonts: 'dist/assets/fonts',
    favicon: 'dist/assets/img/fovicon'
  },
  watch: {
    html: 'src/**/*.html',
    css: 'src/css/**/*.css',
    js: 'src/js/**/*.js',
    images: 'src/img/**/*'
  }
};

// Обработка ошибок
const plumberNotify = (title) => {
  return plumber({
    errorHandler: notify.onError({
      title: title,
      message: 'Error: <%= error.message %>',
      sound: false
    })
  });
};

// Очистка папки dist
const clean = () => {
  return del(['dist']);
};

// Копирование и обработка HTML
const html = () => {
  return gulp.src(paths.src.html)
    .pipe(plumberNotify('HTML'))
    .pipe(fileInclude({
      prefix: '@@',
      basepath: '@file',
      indent: true
    }))
    .pipe(htmlmin({
      collapseWhitespace: true,
      removeComments: true
    }))
    .pipe(gulp.dest(paths.dist.root));
};

// Обработка CSS
const css = () => {
  return gulp.src(paths.src.css)
    .pipe(plumberNotify('CSS'))
    .pipe(sourcemaps.init())
    .pipe(concat('main.css'))
    .pipe(autoprefixer({
      cascade: false,
      grid: true
    }))
    .pipe(gulp.dest(paths.dist.css))
    .pipe(rename({ suffix: '.min' }))
    .pipe(cleanCSS({
      level: 2
    }))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(paths.dist.css));
};

// Обработка JavaScript
const js = () => {
  return gulp.src(paths.src.js)
    .pipe(plumberNotify('JS'))
    .pipe(sourcemaps.init())
    .pipe(concat('main.js'))
    .pipe(gulp.dest(paths.dist.js))
    .pipe(rename({ suffix: '.min' }))
    .pipe(uglify())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(paths.dist.js));
};

// Обработка изображений
const images = () => {
  return gulp.src(paths.src.images)
    .pipe(plumberNotify('Images'))
    .pipe(imagemin([
      imagemin.mozjpeg({ quality: 80, progressive: true }),
      imagemin.optipng({ optimizationLevel: 3 }),
      imagemin.svgo({
        plugins: [
          { removeViewBox: false },
          { cleanupIDs: false }
        ]
      })
    ]))
    .pipe(gulp.dest(paths.dist.images))
    .pipe(webp({ quality: 80 }))
    .pipe(gulp.dest(paths.dist.images));
};

// Копирование фавиконок
const favicon = () => {
  return gulp.src(paths.src.favicon)
    .pipe(gulp.dest(paths.dist.favicon));
};

// Копирование шрифтов (если есть)
const fonts = () => {
  return gulp.src(paths.src.fonts)
    .pipe(gulp.dest(paths.dist.fonts));
};

// Наблюдение за файлами
const watch = () => {
  gulp.watch(paths.watch.html, html);
  gulp.watch(paths.watch.css, css);
  gulp.watch(paths.watch.js, js);
  gulp.watch(paths.watch.images, images);
};

// Сборка проекта
const build = gulp.series(
  clean,
  gulp.parallel(html, css, js, images, favicon, fonts)
);

// Режим разработки
const dev = gulp.series(
  build,
  watch
);

// Экспорт задач
exports.clean = clean;
exports.html = html;
exports.css = css;
exports.js = js;
exports.images = images;
exports.favicon = favicon;
exports.fonts = fonts;
exports.build = build;
exports.dev = dev;
exports.watch = watch;
exports.default = dev;
