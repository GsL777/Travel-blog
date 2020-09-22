<?php 

/*
	@package Travel-blog-theme

	=============================
		THEME SUPPORT OPTIONS
	=============================
*/
//travel Theme Options START
//Activates all the post format in dasboard posts -> Format bar on the right. TO ACTIVATE POST FORMATS GO TO newly created travel -> THEME OPTIONS -> select -> save changes and go to the posts.

/*
$options =  get_option( 'post_formats' );
$formats = array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat');
$output = array();
foreach ($formats as $format){
	$output[] = ( @$options[$format] == 1 ? $format : '');
}

if( !empty($options) ){
	add_theme_support('post-formats', $output );
}
*/

//Simplified version of the code above. TO ACTIVATE POST FORMATS GO TO newly created travel -> THEME OPTIONS -> select -> save changes and go to the posts.
$options = get_option('post_formats'); 
if (!empty($options)) { 
	add_theme_support('post-formats', array_keys($options));
}


//Activating theme Options travel->THEME OPTIONS
//Theme support Custom Header. Check the boxes in travel -> Theme Options and it will appear in dashboard Appearance
$header =  get_option( 'custom_header' );//function travel_custom_header function-admin.php 
if(@$header == 1) {
	add_theme_support('custom-header');
}


//Theme support Custom Background. Check the boxes in travel -> Theme Options and it will appear in dashboard Appearance
$background =  get_option( 'custom_background' );//function travel_custom_background function-admin.php
if(@$background == 1) {
	add_theme_support('custom-background');
}
//travel Theme Options END


/*Activate the post thumbnails START*/
add_theme_support( 'post-thumbnails' );//post-thumbnails - Lets to set Featured Image in Wordpress dashboard -> Posts. Developing content.php
/*Activate the post thumbnails END*/


/*Activate Nav Menu Option in WP dashboard START*/
function travel_register_nav_menu(){
	register_nav_menu( 'primary', 'Header Navigation Menu' );//First parameter - location unique name. For two word use _, but do not use -   . Second parameter - description. 
}//add a walker.php file and require in functions.php

add_action('after_setup_theme', 'travel_register_nav_menu');//call an action to activate a function.
/*Activate Nav Menu Option END*/


/*Activate Footer navigation menu START*/
function travel_theme_setup() {
	add_theme_support('menus'); //activatíng menu's writing a string 

	//register_nav_menu('primary', 'Primary Header Navigation'); //first value - string $location, second option - string $description
	register_nav_menu('secondary', 'Footer Navigation');
}
add_action('init', 'travel_theme_setup'); //function to create the menus. Function is executed after the setup theme is triggered. Function will work 'after_setup_theme' or after the initialization 'init'
/*Activate Footer navigation menu END*/


/*
	==========================================
		 CUSTOM POST TYPE
	==========================================
*/

//CREATES NEW SECTION IN WORDPRESS DASHBOARD

function travel_custom_post_type(){

	$labels = array(
		'name'					=> 'Solutions',
		'singular_name'			=> 'Solution',//singular name will be used in administration panel (dashboard)
		'add_new'				=> 'Add Item',//buttons name 
		'all_items'				=> 'All Items',//administration labels
		'add_new_item'			=> 'Add Item',
		'edit_item'				=> 'Edit Item',
		'new_item'				=> 'New Item',
		'view_item'				=> 'View Item',
		'search_item'			=> 'Search solutions',
		'not_found'				=> 'No items found',
		'not_found_in_trash'	=> 'No items found in trash',
		'parent_item_colon'		=> 'Parent Item'
	);

	$args = array(
		'labels'				=> $labels,
		'public'				=> true,
		'has_archive'			=> true,
		'publicly_queryable'	=> true,
		'query_var'				=> true,
		'rewrite'				=> true,
		'capability_type'		=> 'post',
		'hierarchical'			=> false,
		'supports'				=> array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'revision', //revision - automatically save previous version in database so we could rehover different versions of that specific post type.
			'comments',
		), //type of support - are all the standart information that is found inside a post of a page (the title, the excerpt, thumbnail, custom fields...).
		/*'taxonomies'			=> array( //it will be shown on the WP dashboard new created custom post type
			'category',
			'post_tag'
		),*/
		'menu_position'			=> 5,
		'exclude_from_search'	=> false
	);

	register_post_type('solutions', $args);//First value - the slug(name of solutions). Second value - contains all the arguments of the created post type.

}

add_action('init', 'travel_custom_post_type');

/*
	==========================================
		 CUSTOM TAXONOMY
	==========================================
*/
function travel_custom_taxonomies(){//After adding taxonomies link, do not forget to "refresh" the permalinks in WP dashboard (switch back to 'simple or regular' permalinks' go to page, refresh and clean the cache) otherwise your archive page for the custom Taxonomies will end up in a 404.!!!!!!!

	//First type of taxonomy.
	//add new taxonomy hierarchical
	$labels = array(
		'name'				=> 'Fields',//like a category in a WP dashboard -> post
		'singular_name'		=> 'Field',
		'search_items'		=> 'Search Fields',
		'all_items'			=> 'All Fields',
		'parent_item'		=> 'Parent Field',
		'parent_item_colon'	=> 'Parent Field:',
		'edit_item'			=> 'Edit Field',
		'update_item'		=> 'Update Field',
		'add_new_item'		=> 'Add New Field',
		'new_item_name'		=> 'New Field Name',
		'menu_name'			=> 'Field'
	);

	$args = array(
		'hierarchical'		=> true, 
		'labels'			=> $labels,
		'show_ui'			=> true,
		'show_admin_column'	=> true,
		'query_var'			=> true,
		'rewrite'			=> array( 'slug' => 'field' )//mysite.com/development. If the slug is rewtritten mysite.com/field/development

	);

	register_taxonomy('field', array('solutions'), $args);//First value - name of the taxonomy and it is better that it will match the slug (in this case type).//Second parameter - object type that gives the ability to specify which post type we whant to attach this custom taxonomy(in this case insert the same as in the register_post_type('solutions', $args); custom post type name).//Third value - the arguments that contains all the labels and all the parameters

	//Second type of taxonomy.
	//add new taxonomy NOT hierarchical

	register_taxonomy( 'travel', 'solutions', array(
		'label'			=> 'travel',
		'rewrite'		=> array( 'slug' => 'travel' ),
		'hierarchical'	=> false

	) );

}

add_action('init', 'travel_custom_taxonomies');// when the new custom post type is created need a new single-solutions.php file in this case and in it need to change the_category(' '); and the_tags(); code to function, because it will not work.



/*
	==========================================
		BLOG LOOP CUSTOM FUNCTIONS
	==========================================
*/

function travel_get_attachment( $num = 1 ){//content-image.php entry-header style="background-image: url()"
//variable $num = 1 - if there will be declared a function without a variable the default value will be 1, but no Null and it will not break a code. Than change a 'posts_per_page' number with a variable $num.
	$featured_image = '';//$featured_image from entry-header style="background-image:url()"
		if( has_post_thumbnail() && $num == 1 ): //if the featured picture is set in WordPress dashboard.
			$featured_image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
			//WP function wp_get_attachment_url() - retrive the url of picture if we know the ID of that specific picture.
			//get_post_thumbnail_id() - To get the id.
			//get_the_ID() - as a value to specify a post id.
		else:
			//if the picture is not set as a featured image and putted to a text area with upload media button. Than we need to put an empty variable $featured_image = ''; above all code and add an else
			$attachments = get_posts( array(
				'post_type'			=>	'attachment',// WordPress saves everything as a post type (A post, A page, attachment). 'attachment' - means that there will be only images inside.
				'posts_per_page'	=> $num,//'posts_per_page' - image to print. 1 - is a limitation of posts that is retrieving.
				'post_parent'		=> get_the_ID()//'post_parent' - declare what kind of parent we whant to check, whick post we whant to check otherwise it will retrive all the atachments we ever uploaded to WordPress.
			) );//retrive all the attachments to a specific posts. Function get_posts - get a specific list of posts asign to this current post.

			//var_dump($attachments);

			if( $attachments && $num == 1 ): //check if attachments is not empty.
				foreach ($attachments as $attachment) ://loop to access the array to navigate in it properly.
					$featured_image = wp_get_attachment_url( $attachment->ID );//we have to access id of attachment variable and navigating inside of the object array and retrive the object id that is the same value as it was written with var_dump($attachments); and was found that it is ["ID"] => int(47).
				
				endforeach;
			elseif( $attachments && $num > 1 ):
				$featured_image = $attachments; 
				
			endif;

			wp_reset_postdata();//we are not affect the blog loop that is inside index and not going to disrupt our homepage.

		endif;//GO TO WP DASBOARD -> MEDIA -> SELECT LIST ICON ON THE LEFT AND UNATTACH ALL OF THE IMAGES. THAN GO TO POSTS -> SELECT A POST -> ADD MEDIA -> SELECT A PICTURE -> INSERT PHOTO -> MAKE SURE IT IS UNDER THE TEXT -> UPDATE. IF IT DOESN'T WORK REUPLOAD AN IMAGE.

		return $featured_image;
}


/*
	==========================================
		SINGLE POST CUSTOM FUNCTIONS
	==========================================
*/

function travel_post_navigation(){ //function putted to single.php to change the_post_navigation(); function.

	$nav = '<div class="row post-navigation">';

	$prev = get_previous_post_link( '<div class="post-link-nav"><i class="fa fa-angle-left"></i>%link<span class="travel-icon travel-prev-icon" aria-hidden="true"></div>', '%title' );//%link - WP shortcode to recognise that link is a placeholder to print the link in this location.
	$nav .= '<div class="col-xs-12 col-sm-6 text-left">' . $prev . '</div>';

	$next = get_next_post_link( '<div class="post-link-nav">%link<span class="travel-icon travel-next-icon" aria-hidden="true"><i class="fa fa-angle-right"></i></span></div>', '%title' );
	$nav .= '<div class="col-xs-12 col-sm-6 text-right">' . $next . '</div>';

	$nav .= '</div>';

	return $nav;
}


// Activate HTML5 features for comments
add_theme_support( 'html5', array(
	'comment-list', 'comment-forum', 'search-form', 'gallery', 'caption') 
);

function get_post_navigation(){
	//if( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ):
		require_once( get_template_directory() . '/inc/comment-nav.php' );
	//endif;
}


//function for testing CONTACT FORM email START
//FILES INCLUDE main-jquery.js, function.php(to add ajax.php), contact-form.php, ajax.php, shortcodes.php, custom-post-type.php, contact.scss 

//TURN OFF IF IT IS NOT IN USE
/*
function mailtrap($phpmailer) {//code in ajax.php function travel_save_contact();
  $phpmailer->isSMTP();
  $phpmailer->Host = 'smtp.mailtrap.io';
  $phpmailer->SMTPAuth = true;
  $phpmailer->Port = 2525;
  $phpmailer->Username = '5ef4715c46507e';
  $phpmailer->Password = '4fa836c30aacff';
}

add_action('phpmailer_init', 'mailtrap');
//function for testing CONTACT FORM email END
*/

/* Initialize global Mobile Detect START 
function mobileDetectGlobal(){//CALL THE FUNCTION IN ALL THE CONTENT as example in content-image.php	global $detect;

	global $detect;
	$detect = new Mobile_Detect;
}

add_action('after_setup_theme', 'mobileDetectGlobal');//after_setup_theme - WordPress built in action 
/* Initialize global Mobile Detect END */

/*
	==========================================
		SIDEBAR FUNCTIONS
	==========================================
*/

function travel_sidebar_init(){//in sidebar.php and index.php files
	register_sidebar(
		array(
			'name'			=> esc_html__( 'Travel Sidebar', 'traveltheme' ),
			'id'			=> 'travel-sidebar',
			//'class'			=> 'sidebar-custom',//applies only in the backend
			'description'	=> 'Dynamic Right Sidebar',
			'before_widget' => '<section id="%1$s" class="travel-widget %2$s">',//%1$s - (%) are connected to the sprintf php function and to the id and ($) the class of a sidebar. The class change based on the class that is specified and the id changes based on the id that is specified.
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="travel-widget-title">',
			'after_title'   => '</h2>'

		)
	);
}

add_action('widgets_init', 'travel_sidebar_init');//to activate travel_sidebar_init function


/*
	===========================================================
		FOR THE BUG FIX TO LOAD THE LOCALHOST ON REFRESH  START
	===========================================================
*/
//function used in archive.php
function travel_grab_current_uri(){

	$http = ( isset( $_SERVER["HTTPS"] ) ? 'https://' : 'http://' );

	//$referer = ( isset($_SERVER["HTTP_REFERER"]) ? rtrim($_SERVER["HTTP_REFERER"], "/") : $http . $_SERVER["HTTP_HOST"] );
	$referer = $http . $_SERVER["HTTP_HOST"];//$referer update

	$archive_url = $referer . $_SERVER["REQUEST_URI"];  //to remove the last character that is inside the string need to use PHP function r_trim. HTTP_REFERER - request for the server to print http referer for the LOCALHOST.

	return $archive_url;
}

/*
	=========================================================
		FOR THE BUG FIX TO LOAD THE LOCALHOST ON REFRESH END
	=========================================================
*/


function page_title(){//function in header.php
	// $title = get_the_title($post);
	$parent_title = get_the_title($post->post_parent);

	// return $title;
	return $parent_title;
}



/*
	===============================
		SOCIAL SHARE BUTTONS START
	===============================
*/

function header_social_btn(){
	// $title = get_the_title();
	// $permalink = get_permalink();


	//Compose the share links for Facebook, Twitter, LinkedIn, Instagram
	$facebook = sprintf('https://en-gb.facebook.com/login/');
	$linkedin = sprintf('https://www.linkedin.com/');
	$twitter = sprintf('https://twitter.com/login?lang=en-gb');

	$instagram = sprintf('https://www.instagram.com/accounts/login/');
	// $facebook = 'https://www.facebook.com/sharer/sharer.php?u=' . $permalink;
	$github = sprintf('https://github.com/GsL777');


	// Wrap the buttons
	$output = '<div class="socials-container">';
		// Add the links inside the wrapper
		$output .= '<div class="socials facebook"><a href="' . $facebook . '" target="_blank" rel="nofollow"><i class="fa fa-facebook fa-2x" aria-hidden="true"></i></a></div>';

		$output .= '<div class="socials linkedin"><a href="' . $linkedin . '" target="_blank" rel="nofollow"><i class="fa fa-linkedin fa-2x" aria-hidden="true"></i></a></div>';

		$output .= '<div class="socials twitter"><a href="' . $twitter . '" target="_blank" rel="nofollow"><i class="fa fa-twitter fa-2x" aria-hidden="true"></i></a></div>';

		$output .= '<div class="socials instagram"><a href="' . $instagram . '" target="_blank" rel="nofollow"><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></a></div>';

		$output .= '<div class="socials github"><a href="' . $github . '" target="_blank" rel="nofollow"><i class="fa fa-github fa-2x" aria-hidden="true"></i></a></div>';

	$output .= '</div>';

	return $output;
}


function footer_social_btn(){
	// $title = get_the_title();
	// $permalink = get_permalink();


	//Compose the share links for Facebook, Twitter, LinkedIn, Instagram
	$facebook = sprintf('https://en-gb.facebook.com/login/');
	$linkedin = sprintf('https://www.linkedin.com/');
	$twitter = sprintf('https://twitter.com/login?lang=en-gb');

	$instagram = sprintf('https://www.instagram.com/accounts/login/');
	// $facebook = 'https://www.facebook.com/sharer/sharer.php?u=' . $permalink;
	$github = sprintf('https://github.com/GsL777');


	// Wrap the buttons
	$output = '<div class="footer-socials">';
		// Add the links inside the wrapper
		$output .= '<a class="icon-link round facebook fill" href="' . $facebook . '" target="_blank" rel="nofollow"><i class="fa fa-facebook" aria-hidden="true"></i></a>';

		$output .= '<a class="icon-link round linkedin fill" href="' . $linkedin . '" target="_blank" rel="nofollow"><i class="fa fa-linkedin" aria-hidden="true"></i></a>';

		$output .= '<a class="icon-link round twitter fill" href="' . $twitter . '" target="_blank" rel="nofollow"><i class="fa fa-twitter" aria-hidden="true"></i></a>';

		$output .= '<a class="icon-link round github fill" href="' . $github . '" target="_blank" rel="nofollow"><i class="fa fa-github" aria-hidden="true"></i></a>';

	$output .= '</div>';

	return $output;
}

/*
	===============================
		SOCIAL SHARE BUTTONS END
	===============================
*/


/*
	===============================
		YEAR START
	===============================
*/

	function year(){
		date_default_timezone_set('Europe/London'); 
		$this_year = date('Y');

		return $this_year;
	}
	
/*
	===============================
		YEAR END
	===============================
*/