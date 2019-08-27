#!/usr/bin/env node
/* eslint-disable no-console */
const packageJson = require("../package.json");
const version = packageJson.version;
const argv = require("yargs").argv;
const colors = require("colors"); // eslint-disable-line no-unused-vars
const replace = require("replace");

const updateVersion = (version, releaseType) => {
  let currentVersion = version.split(/[.]+/);
  let newPatch;
  let newMinor;
  let newMajor;
  let newVersion;
  console.log(`Current theme version: ${version}`.yellow);

  if (releaseType.patch) {
    console.log("Updating theme version as a patch release.".cyan);

    // increment patch number
    currentVersion[2]++;
    newPatch = currentVersion[2];

    // New Version Number
    newVersion = currentVersion[0] + "." + currentVersion[1] + "." + newPatch;
    console.log("New theme version is: ".green + newVersion.green.bold);
  }

  if (releaseType.minor) {
    console.log("Updating theme version as a minor release.".cyan);

    // increment minor number
    currentVersion[1]++;
    newMinor = currentVersion[1];

    // New Version Number
    newVersion = currentVersion[0] + "." + newMinor + "." + "0";
    console.log("New theme version is: ".green + newVersion.green.bold);
  }

  if (releaseType.major) {
    console.log("Updating theme version as a major release.".cyan);

    // increment minor number
    currentVersion[0]++;
    newMajor = currentVersion[0];

    // New Version Number
    newVersion = newMajor + "." + "0" + "." + "0";
    console.log("New theme version is: ".green + newVersion.green.bold);
  }

  // first replace updates strings
  replace({
    regex: version,
    replacement: newVersion,
    paths: ["./style.css"],
    silent: true
  });

  replace({
    regex: `"version": "${version}"`,
    replacement: `"version": "${newVersion}"`,
    paths: ["./package.json"],
    silent: true
  });
};

updateVersion(version, argv);
