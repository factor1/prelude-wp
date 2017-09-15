# Mixins
> File Location: `assets/scss/mixins/_sugar.scss`

Prelude includes a few mixins to help your theme development along. We've merged
these mixins in from a prior mixin package we created called Sugar, hence the
file name.

## Convert pixel to rem
Easily convert pixel values to rems.

**Function:**
```scss
@function rem($size) {
  $remSize: $size/16;
  @return #{$remSize}rem;
}
```
**Usage:**
```scss
font-size: rem(24);
```

## Aspect Ratio
Maintain aspect ratio on a certain element. Perfect for use on hero elements.

**Function:**
```scss
@mixin aspect-ratio($width, $height) {
  position: relative;
  &:before {
    display: block;
    content: "";
    width: 100%;
    padding-top: ($height / $width) * 100%;
  }
}
```

**Usage:**
```scss
.hero {
  @include aspect-ratio(16,9);
}
```
