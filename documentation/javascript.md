# JavaScript
Prelude includes two JavaScript helpers to aid in your theme's development.

## Touch Detection
Removes `no-touch` body class if device has touch.

```js
var isTouchDevice = 'ontouchstart' in document.documentElement;
if( isTouchDevice ) {
  $('body').removeClass('no-touch');
}
```

## Browser Detection
Prelude includes [Bowser](https://github.com/lancedikson/bowser) to aid in
browser detection. You can modify these as needed but by default is as follows:

```js
if( bowser.msie && bower.version == 11 ) {
  $('body').addClass('ie-11');
} else if ( bowser.safari ) {
  $('body').addClass('safari');
}
```
