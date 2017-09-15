# Prelude Styles
The major goal for Prelude is to give the developer a great starting point for
creating WordPress themes. We try our best to keep the styles up to you, but we
do include some core styles to give you a good starting point.

## Normalize
Prelude uses a [sass build of Normalize](https://github.com/JohnAlbin/normalize-scss) to make things, well, normal.

From https://necolas.github.io/normalize.css/:

> Normalize.css makes browsers render all elements more consistently and in line
with modern standards. It precisely targets only the styles that need normalizing.

## WordPress Styles
> File Location: `assets/scss/globals/_wordpress.scss`

We include some core WordPress classes such as `alignright` to make sure that when a user makes changes
via a WYSIWYG they are rendered correctly. You may edit these classes as you desire.

## Global Styles
> File Location: `assets/scss/globals/_global.scss`

We include some base styles we found ourselves always using on our sites. These
styles are pretty small and concise but you may also adjust these as you wish. View
the file for more information.

### Helper Classes/Styles
Two key things found in `_globals.scss` are the `img` property and the `flex-video`
class.

- `img` - small css to make sure images do not spill out of their containers.
- `.flex-video` styles for ensuring `iframes` (usually for videos) are responsive.

#### Example Flex Video Usage

```html
<div class="flex-video">
  <iframe width="560" height="315" src="https://www.youtube.com/embed/_cOV_S3S8Yc" frameborder="0" allowfullscreen></iframe>
</div>
```

## Social Menu Styles
> File Location: `assets/scss/components/_social-menu.scss`

The social menu styles can be found here. Adjust these when using the `prelude_social_menu()`
function. 
