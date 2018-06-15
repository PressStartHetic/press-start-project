const babelify    = require('babelify');
const browserify  = require('browserify');
const buffer      = require('vinyl-buffer');
const concat      = require('gulp-concat');
const del         = require('del');
const gulp        = require('gulp');
const imagemin    = require('gulp-imagemin');
const gulpif      = require('gulp-if');
const minifyCSS   = require('gulp-csso');
const sass        = require('gulp-sass');
const source      = require('vinyl-source-stream');
const sourcemaps  = require('gulp-sourcemaps');
const uglify      = require('gulp-uglify');
const autoprefixer= require('gulp-autoprefixer');
const pxtorem     = require('gulp-pxtorem');
const cleaner     = require('gulp-clean');

const isProd = process.env.NODE_ENV === 'production';

const paths = {
    css: {
      src: [
        './assets/scss/style.scss',
      ],
      out: 'style.min.css',
      dist: './web/css'
    },
    js: {
      src: [
        './assets/js/test.js',
        './assets/js/app.js'
      ],
      concat: [
        './web/js/dist.min.js'
      ],
      app: {
        min: 'app.min.js',
        js: 'app.js'
      },
      dist: {
        path: './web/js',
        clean: './web/js/dist.min.js',
        min: 'dist.min.js'
      },
    },
    img: {
      src: './assets/img/**/*',
      dist: './web/img'
    },
    dist: [
      'dist'
    ],
    watch: {
      css: 'assets/**/*.scss',
      js: 'assets/js/*.js',
      img: 'assets/img/*'
    }
};

/**
 * SCSS
 */

function scss() {
  return gulp.src(paths.css.src)
    .pipe(concat(paths.css.out))
    .pipe(gulpif(!isProd, sourcemaps.init()))
    .pipe(sass())
    .pipe(autoprefixer({browsers: ['last 2 versions'], cascade: false }))
    .pipe(pxtorem())
    .pipe(minifyCSS())
    .pipe(gulp.dest(paths.css.dist));
}

/**
 * JS
 */

function js() {
  return browserify({entries: paths.js.src, debug: true})
    .transform(babelify, {presets: 'es2015'})
    .bundle()
    .pipe(source(paths.js.app.js))
    .pipe(buffer())
    .pipe(uglify())
    .pipe(concat(paths.js.dist.min))
    .pipe(gulp.dest(paths.js.dist.path))
    .on('end', function () {
      gulp.src(paths.js.concat)
        .pipe(concat(paths.js.app.min))
        .pipe(gulp.dest(paths.js.dist.path))
        .on('end', function() {
          gulp.src(paths.js.dist.clean)
          .pipe(cleaner({force: true}));
        });
    });
};

/**
 * IMAGES
 */

function images() {
  return gulp.src(paths.img.src)
    .pipe(gulpif(isProd, imagemin({verbose: true})))
    .pipe(gulp.dest(paths.img.dist));
}

/**
 * GLOBAL
 */

function clean() {
  return del(paths.dist);
}



gulp.task('default', gulp.parallel(scss, js, images, function(done) {

  gulp.watch(paths.watch.css, scss);
  gulp.watch(paths.watch.js, js);
  gulp.watch(paths.watch.img, images);

  done();
}));
