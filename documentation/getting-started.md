# Getting Started
Prelude requires that you have Node.js/npm and Gulp installed on your machine.
Visit their respective documentation pages for information on these dependencies.

## Installation

**1.** Create a new `package.json` for your project by running `yarn init`

> **NOTE** - Prelude 5 has made the switch to yarn as a package manager.

**2.** Install prelude-wp, `yarn add prelude-wp`

Prelude will then show a prompt if you want to move theme files into your project
directory. Selecting "Y" will attempt to move theme files.

> **Note:** This feature may not be supported on all Operating Systems, if it fails
you may need to manually move files into your theme directory.

**3.** Create a `.env` file in your project with some key information, like the URL to be used for your project. If no URL is specified it will default to `localhost:3000`.

```
WP_URL="http://testproject.local/"
```

After these three steps, you are ready to start developing your theme.
