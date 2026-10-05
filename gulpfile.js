var gulp = require("gulp");
const sass = require("gulp-sass")(require("sass"));
var rtlcss = require("gulp-rtlcss");
var rename = require("gulp-rename");
const errorHandler = require("gulp-error-handle");
var lec = require("gulp-line-ending-corrector");

// Watch SCSS and rebuild CSS + RTL.
gulp.task("default", function () {
  gulp.watch("scss/**/*.scss", gulp.series(["elemental-addons-sass", "elemental-addons-rtl"]));
});

// Task 1 - scss to css
gulp.task("elemental-addons-sass", function () {
  return gulp
    .src(["scss/**/*.scss", "!scss/**/_*.scss"])
    .pipe(errorHandler())
    .pipe(sass().on("error", sass.logError))
    .pipe(lec())
    .pipe(gulp.dest("assets/css"));
});

// Task 2 - css to rtl-css
gulp.task("elemental-addons-rtl", function () {
  return gulp
    .src([
      "assets/css/**/*.css",
      "!assets/css/**/*.rtl.css",
      // Hand-maintained / third-party CSS — do not RTL-regenerate.
      "!assets/css/admin-about.css",
      "!assets/css/base.css",
      "!assets/css/elementor-mascot.css",
      "!assets/css/isotope-layout.css",
      "!assets/css/widgets-manager.css",
      "!assets/css/images/**",
    ])
    .pipe(rtlcss())
    .pipe(rename({ suffix: ".rtl" }))
    .pipe(lec())
    .pipe(gulp.dest("assets/css/"));
});

gulp.task("build", gulp.series("elemental-addons-sass", "elemental-addons-rtl"));
