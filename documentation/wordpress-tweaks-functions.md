# WordPress Tweaks & functions.php
We include some handy WordPress tweaks for various purposes. Some make developing
a theme easier, some are UX fixes, and some are because we like them.

## functions.php
The `functions.php` file should only hold `requires` to files located in `/inc`.
It is (in our opinion) a best practice to put no __actual__ code here.

## Custom Post Types
> File Location: `inc/custom-post-types.php`

If you would like to include custom post types in your theme, they can be added
to `inc/custom-post-types.php`. By default, this file is empty.

>**Note:** You may want to add custom post types to a custom plugin instead, to ensure
that they are kept from theme to theme.

## Script & Style Enqueues
> File Location: `inc/enqueues.php`

All JavaScript and CSS files should be enqueued here so they can be properly handled
by WordPress.

### defer_parsing_of_js()
We also use a function named `defer_parsing_of_js` to defer parsing of JavaScript
files that _aren't_ `jquery.js` to help improve load times for your theme. If you
are experiencing plugin or jQuery issues, try removing this function as part of
your initial troubleshooting but generally does not negatively impact how WordPress
handles JS/jQuery and plugins.

```php
if (!(is_admin() )) {
  function defer_parsing_of_js ( $url ) {
    if ( FALSE === strpos( $url, '.js' ) ) return $url;
    if ( strpos( $url, 'jquery.js' ) ) return $url;
    // return "$url' defer ";
    return "$url' defer onload='";
  }
  add_filter( 'clean_url', 'defer_parsing_of_js', 11, 1 );
}
```

## WordPress Menus
> File Location: `inc/menus.php`

By default we include three WordPress Nav Menus:
- primary
- footer
- social

**Primary** is generally used for main site navigation, **footer** is for footer
menus that may differ from the primary menu, and **social** can be used for social
accounts. The **social** menu is tied to the `prelude_social_menu` function covered
below.

### prelude_social_menu()
The prelude social menu function makes it easy to add social media accounts to the
theme. It will automatically add social media icons (via [Font Awesome](http://fontawesome.io))
to the links in this menu.

#### Social Menu Styles
> File Location: `assets/scss/components/_social-menu.scss`

This file contains the styles for when the social media menu is rendered. You can
change these styles to fit your theme. We try to include a well rounded list of
social media services will keeping it lean and mean. If you see a missing service
you'd like to see included, feel free to [open an issue](https://github.com/factor1/prelude-wp/issues/).

## Shortcodes
> File Location: `inc/shortcodes.php`

You may add any theme specific shortcodes here. By default, this file is empty.

## Thumbnails
> File Location: `inc/thumbnails.php`

Be smart! Use thumbnails! Thumbnails ensure that the end client cannot upload
massive images and allow them to be displayed in the theme, ensuring your theme
loads as fast and light as possible.

You can use this file to add or edit thumbnail sizes but it also includes two
useful functions to get featured images.

### featuredURL()
The `featuredURL` function will echo the URL of a featured post.

#### Arguments
- `$size` - pass the thumbnail size you wish to use. (Accepts a string, default: `'full'`)

##### Function:
```php
function featuredURL($size = 'full'){
  $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $size );
  $url = $thumb['0'];
  echo $url;
}
```

## Widgets
> File Location: `inc/widgets.php`

The widgets file adds a few useful widget areas as well as removing some lesser
used widgets.

**Widgets Added**
- Sidebar (id: `sidebar-1`)
- Footer Area 1 (id: `footer-widget`)
- Footer Area 2 (id: `footer-widget-2`)
- Footer Area 3 (id: `footer-widget-3`)
- Footer Area 4 (id: `footer-widget-4`)

**Widgets Removed**
- `WP_Widget_Calendar`
- `WP_Widget_Links`
- `WP_Widget_Meta`
- `WP_Widget_Search`
- `WP_Widget_Recent_Comments`
