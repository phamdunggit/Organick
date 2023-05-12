const { src, dest, series, watch } = require("gulp");
const scss = require("gulp-sass")(require("sass"));
const autoprefix = require("gulp-autoprefixer");
const cssMinfy = require("gulp-clean-css");

const jsMinify = require("gulp-terser");
const browserSync = require("browser-sync").create();

function styles() {
  return src("./scss/*.scss")
    .pipe(scss())
    .pipe(autoprefix("last 2 version"))
    .pipe(cssMinfy())
    .pipe(dest("./css/"))
    .pipe(browserSync.stream());
}
function block_styles() {
  return (
    src("./blocks/scss/*.scss")
      .pipe(scss())
      .pipe(autoprefix("last 2 version"))
      // .pipe(cssMinfy())
      .pipe(dest("./blocks/css/"))
      .pipe(browserSync.stream())
  );
}
function scripts() {
  return src("./custom-js/*.js")
    .pipe(jsMinify())
    .pipe(dest("./js/"))
    .pipe(browserSync.stream());
}

function watchTask() {
    // ghostMode: false,
    browserSync.init({
      proxy: "http://organick.local/",
    });

  watch(
    [
      "./scss/*.scss",
      "./blocks/scss/*.scss",
      "./custom-js/*.js",
      "./*.php",
      "./**/*.php",
    ],
    series(styles, scripts, block_styles)
  ).on("change", browserSync.reload);
}
exports.default = series(styles, block_styles, scripts, watchTask);
