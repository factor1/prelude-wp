"use strict";

require("dotenv").config();

const browserSync = require("browser-sync").create();
const colors = require("colors");
const imagemin = require("gulp-imagemin");
const { src, dest, watch } = require("gulp");

const NODE_ENV = process.env.NODE_ENV;
const URL = process.env.WP_URL;

// Project Paths
const phpFiles = ["./**/*.php", "./*.php"];
const dist = "./dist/";
const imageFiles = ["./assets/img/*.{jpg,png,gif}"];

// compress images
const compressImages = () => {
  return src(imageFiles)
    .pipe(imagemin())
    .pipe(dest("./assets/img/"));
};

// browser sync server
const server = () => {
  console.log(colors.green.bold(`🛠  Running in ${NODE_ENV} mode`)); // eslint-disable-line no-console
  browserSync.init({
    proxy: URL ? URL : "http://localhost:3000"
  });

  watch(`${dist}/theme.css`).on("change", browserSync.reload);
  watch(`${dist}/theme.js`).on("change", browserSync.reload);
  watch(phpFiles).on("change", browserSync.reload);
};

module.exports = {
  build: compressImages,
  serve: server
};
