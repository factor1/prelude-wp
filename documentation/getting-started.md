# Getting Started
Prelude requires that you have Node.js/npm and Gulp installed on your machine.
Visit their respective documentation pages for information on these dependencies.

## Installation

**1.** Create a new `package.json` for your project by running `npm init`

**2.** Install prelude-wp, `npm install prelude-wp --save`

Prelude will then show a prompt if you want to move theme files into your project
directory. Selecting "Y" will attempt to move theme files.

> **Note:** This feature may not be supported on all Operating Systems, if it fails
you may need to manually move files into your theme directory.

**3.** Update theme name in `gulpfile.js` and `style.css` to reflect your project's
information as well as updating the `url` variable in `gulpfile.js` to reflect
your development URL.

After these three steps, you are ready to start developing your theme.
