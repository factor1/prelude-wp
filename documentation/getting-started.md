# Getting Started

Prelude requires that you have at least Node 10 installed on your machine.

## Installation

**1.** Run `npx prelude-wp your-theme-name` to run in the prelude installer and create your project folder/directory.

**2.** Create a `.env` file in your project with some key information, like the URL to be used for your project. If no URL is specified it will default to `localhost:3000`. (It's common practice to not commit this file to your repo as it may contain sensative information)

```
WP_URL="http://testproject.local/"
```

After these three steps, you are ready to start developing your theme.

## Working on your theme

To work locally run `yarn start` and the environment will start, create a browsersync server, and watch for any changes.

#### Building For Production

To build for production, run `yarn build`.

#### Testing Javascript

To run tests on your javascript, run `yarn test`

#### Format code

Use prettier to format your code by running `yarn format`

> Testing and Formatting also happen during the build process.
