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

## WordPress Tweaks
> File Location: `inc/tweaks.php`

The tweaks file makes some adjustments to your WordPress install. You may adjust
them as you see fit.

### Theme Support Additions
The following theme supports have been added by default:
- automatic-feed-links
- post-formats
- post-thumbnails
- HTML5
- title-tag

### Theme Support Removals
The following theme supports have been removed by default:
- wp-head
 - rsd_link
 - wlwmanifest_link
 - wp_generator
 - start_post_rel_link
 - index_rel_link
 - adjacent_posts_rel_link

### Content Width (`prelude_content_width()`)
`prelude_content_width()` sets the maximum allowed width for any content in the
theme. See: [WordPress Codex](https://codex.wordpress.org/Content_Width)

```php
function prelude_content_width() {
    $GLOBALS[ 'content_width' ] = apply_filters( 'prelude_content_width', 1200 );
  }
  add_action( 'after_setup_theme', 'prelude_content_width', 0 );
```
### Page Excerpts
There are a few functions to help you control the excerpts that are displayed on
your theme.

#### Add Page Excerpts
`prelude_page_excerpt()` adds support for excerpts in pages.

```php
function prelude_page_excerpt() {
    add_post_type_support( 'page', array('excerpt') );
  }
add_action( 'init', 'prelude_page_excerpt' );
```

#### Customize Default Read More Link
Customize the Read More link that is appended to posts/pages.

```php
// Customize the default read more link
function prelude_continue_reading_link() {
  return ' <a href="' . get_permalink() . '">' .
   __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'theme-slug' ) .
   '</a>';
}
```

#### Customize the default ellipsis
By default, this customizes the default ellipses and appends the output from
`prelude_continue_reading_link()`.

```php
// Customize the default ellipsis (...)
function prelude_auto_excerpt_more( $more ) {
  return '&hellip;' . prelude_continue_reading_link();
}
add_filter( 'excerpt_more', 'prelude_auto_excerpt_more'
```

### Remove Default Gallery Styling (`prelude_remove_gallery_css`)
Removes the default WordPress gallery styling.

```php
function prelude_remove_gallery_css( $css ) {
  return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'prelude_remove_gallery_css' );
```

### Customize Dashboard Widgets (`prelude_remove_dashboard_boxes`)
Removes certain meta boxes from the WordPress dashboard.

```php
// Customize which dashboard widgets show
function prelude_remove_dashboard_boxes() {
  remove_meta_box('dashboard_right_now', 'dashboard', 'core' ); // Right Now Overview Box
  remove_meta_box('dashboard_incoming_links', 'dashboard', 'core' ); // Incoming Links Box
  remove_meta_box('dashboard_quick_press', 'dashboard', 'core' ); // Quick Press Box
  remove_meta_box( 'dashboard_plugins', 'dashboard', 'core' ); // Plugins Box
  remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core' ); // Recent Drafts Box
  remove_meta_box('dashboard_recent_comments', 'dashboard', 'core' ); // Recent Comments
  remove_meta_box('dashboard_primary', 'dashboard', 'core' ); // WordPress Development Blog
  remove_meta_box('dashboard_secondary', 'dashboard', 'core' ); // Other WordPress News
}
add_action( 'admin_menu', 'prelude_remove_dashboard_boxes' );
```

### Remove meta boxes from default posts screen
Removes certain meta boxes from post screens. (Some are commented out for easy
reference.)

```php
function prelude_remove_default_post_metaboxes() {
  remove_meta_box( 'postcustom', 'post', 'normal' ); // Custom Fields Metabox
  //remove_meta_box( 'postexcerpt', 'post', 'normal' ); // Excerpt Metabox
  //remove_meta_box( 'commentstatusdiv', 'post', 'normal' ); // Comments Metabox
  remove_meta_box( 'trackbacksdiv', 'post', 'normal' ); // Talkback Metabox
  //remove_meta_box( 'authordiv', 'post', 'normal' ); // Author Metabox
}
add_action( 'admin_menu', 'prelude_remove_default_post_metaboxes' );
```

### Remove meta boxes from default pages screens
Removes certain meta boxes from page screens. (Some are commented out for easy
reference)

```php
// Remove meta boxes from default pages screen
function prelude_remove_default_page_metaboxes() {
  remove_meta_box( 'postcustom', 'page', 'normal' ); // Custom Fields Metabox
  //remove_meta_box('commentstatusdiv', 'page', 'normal' ); // Discussion Metabox
  remove_meta_box( 'authordiv', 'page', 'normal' ); // Author Metabox
}
add_action( 'admin_menu', 'prelude_remove_default_page_metaboxes' );
```

### Stop automatically linking photos to themselves
Stops WordPress from linking to full-size photos.

```php
// Stop automatically hyper-linking images to themselves
$image_set = get_option( 'image_default_link_type' );
if ( !$image_set == 'none' ) {
  update_option( 'image_default_link_type', 'none' );
}
```

### Customize Yoast SEO Columns
Adjust the Yoast SEO Columns when used.

```php
// Customize the Yoast SEO columns
add_filter( 'wpseo_use_page_analysis', '__return_false' );
```

### Touch Detection (`be_body_classes()`)
Add touch detection class to body.

```php
// Add touch detection class to body
function be_body_classes( $classes ) {
  $classes[] = 'no-touch';
  return $classes;
}
add_filter( 'body_class', 'be_body_classes' );
```

### Keep the WordPress Kitchen Sink Toolkit open (`enable_more_buttons()`)
Keeps the WordPress Kitchen Sink Toolkit open for all users. This can help the
end user(s) edit their content inside of WYSIWYGs.

```php
// Keep the WordPress Kitchen Sink Toolkit open for all users.
function enable_more_buttons($buttons) {
  $buttons[] = 'fontselect';
  $buttons[] = 'fontsizeselect';
  $buttons[] = 'styleselect';
  $buttons[] = 'backcolor';
  $buttons[] = 'newdocument';
  $buttons[] = 'cut';
  $buttons[] = 'copy';
  $buttons[] = 'charmap';
  $buttons[] = 'hr';
  $buttons[] = 'visualaid';
  return $buttons;
}
add_filter("mce_buttons_3", "enable_more_buttons");
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
