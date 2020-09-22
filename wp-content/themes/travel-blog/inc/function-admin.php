<?php 

/*
@package Travel-blog-theme

	=====================
		ADMIN PAGE
	=====================
*/


function travel_add_admin_page(){

	//Generate travel Website Admin Page
	add_menu_page('Travel Website Theme Options', 'Travel', 'manage_options', 'travel_website', 'travel_theme_create_page', 'dashicons-editor-unlink', 110);//First parameter - Page title. Second parameter - menu title. Third parameter - Capability(capability to display options to specific users). Fourth parameter - menu slug(parameter that appears in the navigation bar to avoid errors). Fifth parameter - a function name. Sixth parameter - icon url(wordpress premade icons in https://developer.wordpress.org/resource/dashicons/#art) Need to choose the icon and paste the icon name to the Sixth parameter place. Seventh parameter - the position of a menu that specifies a location.

	//Generate travel Admin Sub Pages
	//travel Theme Options
	add_submenu_page('travel_website', 'travel Theme Options', 'Theme Options', 'manage_options', 'travel_website', 'travel_theme_create_page');

	//travel Contact Form Options
	add_submenu_page('travel_website', 'travel Contact Form', 'Contact Form', 'manage_options', 'travel_website_theme_contact', 'travel_contact_form_page');

	//travel CSS Options
	add_submenu_page('travel_website', 'travel CSS Options', 'Custom CSS', 'manage_options', 'travel_website_css', 'travel_theme_settings_page');

}

add_action('admin_menu', 'travel_add_admin_page');//Activate this function. First value - when to trigger this function (in this case during the generation of admin_menu). Second value - the name of the function that must be triggered.

//Activate custom settings
add_action( 'admin_init', 'travel_custom_settings' );//adding into travel_add_admin_page, because of the safety precautions


//Activate custom settings
function travel_custom_settings(){

	//Theme Support Options
	register_setting('travel-theme-support', 'post_formats');

	add_settings_section( 'travel-theme-options', 'Theme Options', 'travel_theme_options', 'travel_website_theme' );

	add_settings_field( 'post_formats', 'Post Formats', 'travel_post_formats', 'travel_website_theme', 'travel-theme-options' );


	//Custom Header in Theme Support Options
	register_setting('travel-theme-support', 'custom_header');	

	add_settings_field('custom-header', 'Custom Header', 'travel_custom_header', 'travel_website_theme', 'travel-theme-options');


	//Custom Background in Theme Support Options
	register_setting('travel-theme-support', 'custom_background');
	
	add_settings_field('custom-background', 'Custom Background', 'travel_custom_background', 'travel_website_theme', 'travel-theme-options');


	//Contact Form Options
	register_setting( 'travel-contact-options', 'activate_contact' );//travel-contact-form.php and custom-post-type.php files.

	add_settings_section( 'travel-contact-section', 'Contact Form', 'travel_contact_section', 'travel_website_theme_contact' );

	add_settings_field( 'activate-form', 'Activate Contact Form', 'travel_activate_contact', 'travel_website_theme_contact', 'travel-contact-section' );

	//Custom CSS Options
	register_setting( 'travel-custom-css-options', 'website_css', 'travel_sanitize_custom_css');//travel-custom-css.php
	//PUT IN header.php that it will be displayed and will work.

	add_settings_section( 'travel-custom-css-section', 'Custom CSS', 'travel_custom_css_section_callback', 'travel_website_css' ); //travel_website_css - from function travel_add_admin_page(), //travel CSS Options section.
	//travel-custom-css.php

	add_settings_field( 'custom-css', 'Insert your Custom CSS', 'travel_custom_css_callback', 'travel_website_css', 'travel-custom-css-section' );
}


//Post Formats
function travel_post_formats(){
	$options =  get_option( 'post_formats' );
	$formats = array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat');
	$output = '';
	foreach ($formats as $format){
		$checked = ( @$options[$format] == 1 ? 'checked' : '');//@ - means if this variable exists
		$output .= '<label><input type="checkbox" id="' . $format . '" name="post_formats['.$format.']" value="1" '. $checked .' />' . $format . '</label><br>';
	}
	echo $output;//in a callback function for specific settings field have to echo
}//dashboard -> travel -> Theme Options to turn on or off in POSTS -> All posts -> Find post



function travel_custom_header(){
	$options = get_option( 'custom_header' );
	$output = '';

	$checked = ( @$options == 1 ? 'checked' : '' );
	echo '<label><input type="checkbox" id="custom_header" name="custom_header" value="1" '.$checked.' /> Activate the Custom Header</label>';
}//Activate a theme support in inc -> theme-support.php file



function travel_custom_background(){
	$options = get_option( 'custom_background' );
	$output = '';

	$checked = ( @$options == 1 ? 'checked' : '' );
	echo '<label><input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked.' /> Activate the Custom Background</label>';
}//Activate a theme support in inc -> theme-support.php file



//travel Theme Options
function travel_theme_options(){
	echo 'Activate and Deactivate specific Theme Support Options';
}


//Contact Options Functions
function travel_contact_section(){
	echo 'Activate and Deactivate the Built-in Contact Form';
}

//Custom Contact Form
function travel_activate_contact(){//variables from function travel_custom_settings Theme Support Options
	$options =  get_option( 'activate_contact' );
	$checked = ( @$options == 1 ? 'checked' : '');

	echo '<label><input type="checkbox" id="activate_contact" name="activate_contact" value="1" '. $checked .' /></label>';
}//Appears in WP dashboard -> travel


//travel CSS Info
function travel_custom_css_section_callback(){
	echo 'Customize travel Theme with your own CSS';
}

//travel CSS Options
function travel_custom_css_callback(){
	$css = get_option( 'website_css' );
	$css = ( empty($css) ? '/* Travel Theme Custom CSS */' : $css );
	//echo '<textarea placeholder="Sunset Custom Css" >'.$css.'</textarea>';
	echo '<div id="customCss">'.$css.'</div><textarea id="website_css" name="website_css" style="display:none;visibility:hidden;">'.$css.'</textarea>';
}//div id must be the same as in admin-js -> travel.custom_css.js in ace.edit() section.
//Contact CSS Options

//travel CSS Sanitization
function travel_sanitize_custom_css ($input){//Custom CSS Options,register_setting Third parameter.
	//$output = esc_textarea( $input );//sanitize an input. Function incodes all the information in database. //sanitize the input of textarea
	$output = sanitize_textarea_field( $input );//UPDATE FOR esc_textarea($input);
	return $output;
}


//Template submenu functions
function travel_theme_create_page(){ //the same name as Fifth Value in function travel_add_admin_page().
	//echo '<h1>travel Theme Options</h1>';
	require_once( get_template_directory() . '/inc/templates/travel-admin.php' );
}

//travel Contact Options
function travel_contact_form_page(){
	require_once( get_template_directory() . '/inc/templates/travel-contact-form.php' );
}

//travel CSS Options
function travel_theme_settings_page() {
	require_once( get_template_directory() . '/inc/templates/travel-custom-css.php' );
}