<?php 
	/*
		This is the template for the header

		@package Travel-blog-theme
	*/
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php bloginfo('name'); ?><?php wp_title('|'); ?></title><!-- To set a page title go to dashboard Settings -> General -> write in a Site Title a title. It can be seen with an inspect -->
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta charset="<?php bloginfo( 'charset' ); //print the bloginfo charset?>">
	<meta name="viewport" content="width=device-width, initial-scale=1"><!-- for responsive devices to print full screen -->
	<link rel="profile" href="http://gmpg.org/xfn/11"> <!-- necessary for html5 validation  -->
	<?php if( is_singular() && pings_open( get_queried_object() ) ): //check if this page is not an archive, search result or generic blog loop ?>
		<link rel="pingback" href="<?php bloginfo('pingback_url'); //pingback_url - for page to scale up on search engine result page (SERP)?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

	<?php 
		//ON WORDPRESS DASHBOARD -> Photography -> CUSTOM CSS a custom css code could be written
		$custom_css = esc_attr(get_option( 'website_css' ));//website_css - unique handler from function-admin.php //Custom CSS Options
		if(!empty($custom_css) ):
			echo '<style>' . $custom_css . '</style>';
		endif;
	?>

	<body <?php body_class(); //body_class(); - WP prints automatically to what style is used?>>

	<!-- TURN OFF DASHBOARD ON WEBSITE(TO MAKE WEBSITE FASTER): WP dashboard -> Users -> Admin -> Uncheck Toolbar 'Show Toolbar when viewing site'-->


    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarToggler">

            <?php 
                if ( has_nav_menu( 'primary' ) ) :
                    wp_nav_menu(
                        array(
                            'theme_location'    => 'primary',
                            'container'         => false,
                            'menu_class'        => 'navbar-nav nav-positioning',
                            'walker'            => new Travel_Walker_Nav_primary()
                        )
                    );
                endif;
            ?>

            <div class="socials-container">
                <?php echo header_social_btn(); //function in theme-support.php?>
            </div><!-- .socials-container -->

        </div><!-- .collapse -->
    </nav>


    <header class="page-header">
        <div class="container">
            <div class="images" style="background-image: url(<?php header_image(); //header_image(); - php built in function automatically prints the header image. Write a function design_register_nav_menu in theme-support.php before adding image in WP dashboard -> Appearance -> Header ?>);">
                <h2 class="title-back"><b><?php bloginfo( 'description' ); //prints info from WP Dashboard -> Settings -> General -> Site Title ?></b></h2>
                <h3><b><?php bloginfo( 'name' ); //prints info from WP Dashboard -> Settings -> General -> Tagline?></b></h3>
            </div><!-- .images -->

            <div class="page-title">
                <h2 class="text-center">
                    <?php 
                    // $title = get_the_title($post);
                    //$parent_title = get_the_title($post->post_parent);
                    // echo $title;
                    //echo $parent_title;
                    echo page_title();
                     ?>
                </h2>
            </div><!-- .page-title -->
        </div><!-- .container -->
    </header>