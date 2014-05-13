<?php
/*
 * INSTALL:
 *      1. Make sure in the theme folder you have a shortcodes/ folder
 *      2. place shortcode_maker.php into the theme root
 *      3. in the themes functions.php file add: include(get_template_directory().'/shortcode_maker.php');
 *      4. Create your short codes in the shortcodes/ folder, so shortcode [marktest] would be marktest.php
 *          4a. declare the variables you are going to use in your shortcode file, first line of the file:
 *              <?php
 *              # title, summary, learn_more_link
 *              ?>
 *              This above will declare title, summary, and learn_more_link for this shortcode, will show in the instructions page
 *          4b. create an optional instructions file for each shortcode to be displayed in the admin, filename for instructions
 *              on marketst: marktest.instructions
 */

$shortcodeMaker = new shortcodeMaker();

class shortcodeMaker {
    public $capability = 'manage_options';
    public $short_codes = array(); //[shortcode] => array('args' => array());
    public $shortcode_dir = null;
    function __construct() {
        add_action( 'admin_menu', array( &$this, '_add_top_level_menu' ) );
        //loop through and create shortcodes
        $this->shortcode_dir = get_template_directory()."/shortcodes/";
        if ($handle = opendir($this->shortcode_dir)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != ".." && $entry != "_instructions.php") {
                    if(preg_match('/\.php$/', $entry)) {
                        $name = strtolower(str_replace('.php', '', $entry));
                        add_shortcode($name, array(&$this, "_".$name) );
                        $f = fopen($this->shortcode_dir.$entry, 'r'); $line = fgets($f); $line = fgets($f); fclose($f);
                        if(preg_match('/^\#/', $line)) {
                            $this->short_codes[$name] = array('args' => explode(',', trim($line, '#')));
                        } else {
                            $this->short_codes[$name] = array('args' => array());
                        }
                    }
                }
            }
            closedir($handle);
        }
    }
    function __call($name, $args) {
        if(!empty($args[1])) {
            $args[0]['content'] = $args[1];
        }
        return $this->_render(trim($name, '_').".php", $args[0]);
    }
    function _add_top_level_menu() {
        // Settings for the function call below
        $page_title = 'Shortcodes';
        $menu_title = 'Shortcodes';
        $menu_slug = 'shortcode-maker';
        $function = array( &$this, '_display_admin_instructions' );
        #$icon_url = NULL;
        #$position = '';

        // Creates a top level admin menu - this kicks off the 'display_page()' function to build the page
        #$page = add_menu_page($page_title, $menu_title, $this->capability, $menu_slug, $function, $icon_url, 10);

        add_menu_page($page_title, $menu_title, $this->capability, $menu_slug,$function);

    }
    function _display_admin_instructions() {
        echo $this->_render('_instructions.php');

    }
    function _shortcode_get_instructions($shortcode) {
        ob_start();
        if(is_file($this->shortcode_dir.$shortcode.".instructions")) {
            include($this->shortcode_dir.$shortcode.".instructions");
        }
        $_output = ob_get_contents();
        ob_end_clean();
        return $_output;
    }
    function _render($__tpl__, $vars = array()) {
        if(is_array($vars)) {
            foreach($vars as $__ky__=>$__val__) {
                $$__ky__ = $__val__;
            }
        }
        ob_start();
        include($this->shortcode_dir.$__tpl__);
        $_output = ob_get_contents();
        ob_end_clean();
        return $_output;
    }
}