// gulpfile.js
const gulp = require('gulp');
const browserSync = require('browser-sync').create();

function serve() {
  browserSync.init({
    proxy: "http://chaletverkopennl.local", // vervang met jouw lokale URL
    open: false
  });

  gulp.watch("**/*.php").on('change', browserSync.reload);
  gulp.watch("assets/css/**/*.css").on('change', browserSync.reload);
  gulp.watch("assets/js/**/*.js").on('change', browserSync.reload);
}

exports.default = serve;
