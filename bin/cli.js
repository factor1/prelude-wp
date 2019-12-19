#!/usr/bin/env node

/* eslint-disable no-console */

require("colors");

const { exec } = require("child_process");
const fs = require("fs-extra");
const path = require("path");
const _ = require("lodash");
const https = require("https");
const replace = require("replace");
const prompt = require("prompt");

const packageJson = require("../package.json");

const [, , ...project] = process.argv;

const wpCustomize = () => {
  prompt.start();

  prompt.get(
    [
      "Theme_Name",
      "Theme_URI",
      "Author",
      "Author_URI",
      "Description",
      "License",
      "License_URI",
      "Text_Domain"
    ],
    function(err, result) {
      let themeName = result.Theme_Name,
        themeURI = result.Theme_URI,
        author = result.Author,
        authorURI = result.Author_URI,
        description = result.Description,
        license = result.License,
        licenseURI = result.License_URI,
        textdomain = result.Text_Domain;

      if (themeName) {
        replace({
          regex: "Theme Name:",
          replacement: "Theme Name: " + themeName,
          paths: [`${project}/style.css`],
          silent: true
        });
      }

      if (themeURI) {
        replace({
          regex: "Theme URI:",
          replacement: "Theme URI: " + themeURI,
          paths: [`${project}/style.css`],
          silent: true
        });
      }

      if (author) {
        replace({
          regex: "Author:",
          replacement: "Author: " + author,
          paths: [`${project}/style.css`],
          silent: true
        });
      }

      if (authorURI) {
        replace({
          regex: "Author URI:",
          replacement: "Author URI: " + authorURI,
          paths: [`${project}/style.css`],
          silent: true
        });
      }

      if (description) {
        replace({
          regex: "Description:",
          replacement: "Description: " + description,
          paths: [`${project}/style.css`],
          silent: true
        });
      }

      if (license) {
        replace({
          regex: "License:",
          replacement: "License: " + license,
          paths: [`${project}/style.css`],
          silent: true
        });
      }

      if (licenseURI) {
        replace({
          regex: "License URI:",
          replacement: "License URI: " + licenseURI,
          paths: [`${project}/style.css`],
          silent: true
        });
      }

      if (textdomain) {
        replace({
          regex: "Text Domain:",
          replacement: "Text Domain: " + textdomain,
          paths: [`${project}/style.css`],
          silent: true
        });
      }
      console.log("✅  WordPress theme configured".green);
      console.log("💖  Remember - you're amazing.".cyan);
      console.log("✨  Prelude was configured successfully!");
    }
  );
};

console.log(`🛠  Creating theme ${project}...`.cyan);

const setupProject = async () => {
  try {
    await exec(
      `mkdir ${project} && cd ${project} && yarn init --yes`,
      initErr => {
        if (initErr) {
          console.error(
            `😭  Something went really wrong... try again: ${initErr}`.red
          );
        }

        // copy main theme files
        fs.copySync(path.join(__dirname, "../src"), `${project}/`);

        // copy other config files
        const otherFiles = [
          ".babelrc",
          ".browserslistrc",
          ".editorconfig",
          ".eslintignore",
          ".eslintrc"
        ];

        for (let index = 0; index < otherFiles.length; index++) {
          fs.createReadStream(
            path.join(__dirname, `../${otherFiles[index]}`)
          ).pipe(fs.createWriteStream(`${project}/${otherFiles[index]}`));
        }

        const devDependencies = [];
        Object.keys(packageJson.devDependencies).forEach(dep =>
          devDependencies.push(`${dep}@${packageJson.devDependencies[dep]}`)
        );

        const strippedDevDependencies = _.join(devDependencies, " ");

        const dependencies = [];
        Object.keys(packageJson.dependencies).forEach(dep =>
          dependencies.push(`${dep}@${packageJson.dependencies[dep]}`)
        );

        const strippedDependencies = _.join(dependencies, " ");

        // install deps
        console.log("⌛  Installing dependencies...".yellow);
        exec(
          `cd ${project} && yarn add ${strippedDependencies}`,
          (yarnErr, yarnStdout) => {
            if (yarnErr) {
              console.error(yarnErr);
              return;
            }
            console.log(yarnStdout);
            console.log("✅  dependencies installed".green);
            // install dev deps
            console.log("⌛  Installing devDependencies...".yellow);
            exec(
              `cd ${project} && yarn add ${strippedDevDependencies} -D`,
              (yarnErr, yarnStdout) => {
                if (yarnErr) {
                  console.error(yarnErr);
                  return;
                }
                console.log(yarnStdout);
                console.log("✅  devDependencies installed".green);
                console.log("🙈  Setting up .gitignore...".yellow);
                https.get(
                  "https://raw.githubusercontent.com/factor1/prelude-wp/master/.gitignore",
                  res => {
                    res.setEncoding("utf8");
                    let body = "";
                    res.on("data", data => {
                      body += data;
                    });
                    res.on("end", async () => {
                      await fs.writeFile(
                        `${project}/.gitignore`,
                        body,
                        { encoding: "utf-8" },
                        err => {
                          if (err) throw err;
                        }
                      );
                      console.log("✅  .gitignore configured".green);
                      console.log("🎨  Configuring WP Theme Info".yellow);
                      try {
                        wpCustomize();
                      } catch (error) {
                        console.error(
                          "❗ Error configuring WP Theme information",
                          error
                        );
                      }
                    });
                  }
                );
              }
            );
          }
        );

        // add scripts to package.json
        const themePackageJson = `${project}/package.json`;

        const packageScripts = `
          "scripts": {
            "build": "yarn test && yarn format && NODE_ENV=production gulp build && yarn build-js && yarn build-scss",
            "build-js": "parcel build ./assets/js/src/theme.js --out-dir ./dist/ --no-content-hash --log-level 4 --public-url ./dist/",
            "build-scss": "parcel build ./assets/scss/theme.scss --out-dir ./dist/ --no-content-hash --log-level 4 --public-url ./dist/",
            "format": "prettier *.js *.css --write",
            "release-major": "yarn test && node ./util/versionUpdate.js --major && yarn build",
            "release-minor": "yarn test && node ./util/versionUpdate.js --minor && yarn build",
            "release-patch": "yarn test && node ./util/versionUpdate.js --patch && yarn build",
            "start": "NODE_ENV=development yarn test && concurrently \\"yarn watch-js\\" \\"yarn watch-scss\\" \\"gulp serve\\"",
            "test": "eslint .",
            "watch": "concurrently \\"yarn watch-js\\" \\"yarn watch-scss\\"",
            "watch-js": "parcel watch ./assets/js/src/theme.js --out-dir ./dist --log-level 4 --public-url ./dist/",
            "watch-scss": "parcel watch ./assets/scss/theme.scss --out-dir ./dist --log-level 4 --public-url ./dist/"
          }
          `;

        fs.readFile(themePackageJson, (err, file) => {
          if (err) {
            throw err;
          }
          const data = file
            .toString()
            .replace(`"main": "index.js"`, packageScripts); // eslint-disable-line quotes

          fs.writeFile(themePackageJson, data, err2 => err2 || true);
        });
      }
    );
  } catch (error) {
    console.warn("😭  Something terrible happened... Try again.");
    throw new Error(error);
  }
};

setupProject();
