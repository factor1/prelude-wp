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

## Working on your theme
To work locally run `yarn start` and the environment will start.

#### Building For Production
To build for production, run `yarn build`.

#### Testing Javascript
To run tests on your javascript, run `yarn test`

#### Format code
Use prettier to format your code by running `yarn format`

> Testing and Formatting will happen automattically with other processes. You do not need to run independently.
