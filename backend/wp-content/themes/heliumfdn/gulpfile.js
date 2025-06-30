const gulp = require('gulp');
const browserSync = require('browser-sync').create();
const gulpSass = require('gulp-sass')(require('sass'));
const sourcemaps = require('gulp-sourcemaps');
const autoprefixer = require('autoprefixer');
const purgeCSS = require('@fullhuman/postcss-purgecss');
const cleanCSS = require('gulp-clean-css');
const postcss = require('gulp-postcss');
const terser = require('gulp-terser');
const concat = require('gulp-concat');

const paths = {
  scss: 'assets/styles/scss/**/*.scss',
  css: 'assets/styles/css/',
  swiperCss: 'node_modules/swiper/swiper-bundle.min.css',
  jsSrc: 'assets/scripts/js/vendor/**/*.js',
  jsDest: 'assets/scripts/js/',
  php: './**/*.php' // Narrowed to theme directory
};

const jsSrcList = [
  './node_modules/swiper/swiper-bundle.min.js',
  './assets/scripts/js/vendor/what-input.js',
  './assets/scripts/js/vendor/foundation.js',
  './assets/scripts/js/vendor/app.js'
];

// JS Task: Minify with terser, include Swiper
function jsTask() {
  return gulp
    .src(jsSrcList, { allowEmpty: true })
    .pipe(concat('app.min.js'))
    .pipe(terser())
    .pipe(gulp.dest(paths.jsDest))
    .pipe(browserSync.stream());
}

// Sass Task: Compile SCSS with Swiper CSS
function sassTask() {
  return gulp
    .src([paths.swiperCss, paths.scss])
    .pipe(sourcemaps.init())
    .pipe(gulpSass().on('error', gulpSass.logError))
    .pipe(postcss([
      autoprefixer({
        overrideBrowserslist: ['last 2 versions', '> 1%'],
        cascade: false
      }),
      purgeCSS({
        content: [paths.php, ...jsSrcList],
        safelist: [
          'is-active',
          'has-transition-push',
          /^margin-/,
          /^padding-/,
          /^medium-/,
          /^large-/,
          /^xlarge-/
        ]
      })
    ]))
    .pipe(concat('app.css'))
    .pipe(gulp.dest(paths.css))
    .pipe(cleanCSS())
    .pipe(concat('app.min.css'))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(paths.css))
    .pipe(browserSync.stream());
}

// BrowserSync Task: Conditional for dev only
function browserSyncTask(done) {
  if (process.env.NODE_ENV !== 'production') {
    browserSync.init({
      proxy: 'http://localhost:10078',
      port: 3002,
      notify: false,
      open: true,
      logLevel: 'info'
    });
  }
  done();
}

// Watch Task: Run sassTask on PHP changes
function watchTask() {
  gulp.watch([paths.jsSrc, paths.swiperCss], jsTask);
  gulp.watch([paths.scss, paths.swiperCss], sassTask);
  gulp.watch(paths.php, gulp.series(sassTask, (done) => {
    browserSync.reload();
    done();
  }));
}

// Exports
exports.js = jsTask;
exports.sass = sassTask;
exports.watch = watchTask;
exports.default = gulp.series(
  gulp.parallel(jsTask, sassTask),
  browserSyncTask,
  watchTask
);