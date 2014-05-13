<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_theme_data(STYLESHEETPATH . '/style.css');
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtolower($themename) );

	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);

	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {

	// Test data
	$test_array = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");

	// Multicheck Array
	$multicheck_array = array("one" => "French Toast", "two" => "Pancake", "three" => "Omelette", "four" => "Crepe", "five" => "Waffle");

	// Multicheck Defaults
	$multicheck_defaults = array("one" => "true","five" => "true");

	// Background Defaults
	$background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat','position' => 'top center','attachment'=>'scroll');
	
	// Slider Transition Array
	$transition_array = array("1000" => "1 Second", "2000" => "2 Seconds", "4000" => "4 Seconds", "6000" => "6 Seconds", "8000" => "8 Seconds", "10000" => "10 Seconds", "12000" => "12 Seconds", "14000" => "14 Seconds", "16000" => "16 Seconds", "18000" => "18 Seconds", "20000" => "20 Seconds", "30000" => "30 Seconds", "60000" => "1 Minute", "999999999" => "Hold Frame");
	
	// Yes or No Array
	$yesno_array = array("true" => "Yes", "false" => "No");


	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Add all categories option
    $options_categories[0] = "All Categories";

	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages['false'] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_bloginfo('stylesheet_directory') . '/images/';

	$options = array();
	
						
	$options[] = array( "name" => "General Settings",
						"type" => "heading");
						
						
	$options[] = array( "name" => "Address",
						"desc" => "Enter the text you wish to display with the copyright information",
						"id" => "copy_contact",
						"std" => "1234 Any St, anytown, CA  - 949.555.1234",
						"type" => "textarea");
						
	$options[] = array( "name" => "Contact Page Link",
						"desc" => "Choose the page you wish to link to from the footer contact button.",
						"id" => "contact_url",
						"std" => "Select a page:",
						"type" => "select",
						"options" => $options_pages);
						
	$options[] = array( "name" => "Social Media Settings",
						"type" => "heading");

		$options[] = array( "name" => "Facebook URL",
						"desc" => "Please enter URL of your desired facebook page.",
						"id" => "facebook_url",
						"std" => "http://www.facebook.com/yourpage/",
						"type" => "text");
						
	$options[] = array( "name" => "Twitter ID",
						"desc" => "Enter your twitter account name. e.g. twitter.com/<b>factor1</b>",
						"id" => "twitter_url",
						"std" => "yourTwitterName",
						"type" => "text");					
	

	return $options;
}