<?php get_header(); ?>


		<div class="container archive-main">
			<div class="row">

				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="sidebar">
						<div class="sidebar-section">
						<?php get_sidebar(); //sidebar.php . Sidebar in WP Dashboard ->Appearance -> widget. function sidebar_widget_setup() in theme-support.php?>
						</div><!-- .sidebar-section -->
					</div><!-- .sidebar -->
				</div><!-- .col-lg-4 -->


				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 travel-posts-container">
					<div class="text-center no-margin">

						<?php if(have_posts() ): ?>
							
							<header class="page-header">
								<?php 
									the_archive_title('<h1 class="page-title">', '</h1>');
									the_archive_description('<div class="taxonomy-description">', '</div>');
								?>
							</header>

							<?php 

							echo '<div class="page-limit" data-page="' . $_SERVER["REQUEST_URI"] . '">';// / - every time the url is updated the slash(/) removes the pagination if user scroll back in a blog loop. This is for a user that enters a post than decide to press back button and the post remains. ajax.php file.
							// travel_check_paged - a function to replace the ampty status (/), because by default it's going to empty (data-page="/"). It is echoed in travel-load-more-container.
							//$_SERVER["REQUEST_URI"] - is handling the url after the localhost/travel/....

							while(have_posts()): the_post(); 

								 get_template_part('template-parts/content', 'archive'); 

							endwhile;

							echo '</div>';

						endif; ?>
					</div><!-- .row -->

				</div><!-- .col-lg-8 -->


				<div class="container text-center"><!--  In WP dashboard -> Settings -> Reading -> Set the number of posts -->
					<a class="btn-travel-load travel-load-more" data-page="<?php echo travel_check_paged(1);//function in ajax.php ?>" data-archive="<?php echo travel_grab_current_uri();//function in theme-support.php ?>" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
						<span class="travel-icon travel-loading dashicons dashicons-image-rotate"></span><!-- Use span inside <a><a/> not to override any classes or not to trigger any error  -->
						<span class="text">Load More</span><!--  text in mega-menu.js  -->
					</a>
				</div><!-- .container -->

			</div><!-- .row -->
		</div><!-- .container -->


<?php get_footer(); ?>