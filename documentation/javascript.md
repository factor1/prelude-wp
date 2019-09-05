# JavaScript

Prelude includes two JavaScript helpers to aid in your theme's development. It also uses Babel so you can use the latest JavaScript functionality such as arrow functions and more.

## Touch Detection

Removes `no-touch` body class if device has touch.

```js
var isTouchDevice = "ontouchstart" in document.documentElement;
if (isTouchDevice) {
  $("body").removeClass("no-touch");
}
```

## Browser Detection

Prelude includes [Bowser](https://github.com/lancedikson/bowser) to aid in
browser detection. You can modify these as needed.
