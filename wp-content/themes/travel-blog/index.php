<?php 

/* 
	@package Travel-blog-theme 
*/

get_header(); ?>

<div id="primary-home" class="content-home">
	<main id="main-home" class="site-home" role="main">




		<section class="blog-content">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<div class="sidebar">
							<div class="sidebar-section">
							<?php get_sidebar(); //sidebar.php and theme-support.php files?>
							</div><!-- .sidebar-section -->
						</div><!-- .sidebar -->
					</div><!-- .col-lg-4 -->


					<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 travel-posts-container">
					<?php 
						$currentPage = (get_query_var('paged')) ? get_query_var('paged') : 1;

						$args = array(
							// 'posts_per_page' => 2,//was set in WP admin Settings -> Reading -> Blog pages show at most
							'order'		=> 'DESC',
							// 'cat'		=> -14, //hides gallery category
							'paged'		=> $currentPage
						);

						query_posts($args);

						if(have_posts() ): 

							$i = 0;

							//add code to ajax.php, mega-menu.js
							echo '<div class="page-limit" data-page="/' . travel_check_paged() . '">';

							//  / - every time the url is updated the slash(/) removes the pagination if user scroll back in a block loop. This is for a user that enters a post than decide to press back button and the post remains. ajax.php file.
							// travel_check_paged - a function to replace the ampty status (/), because by default it's going to empty (data-page="/"). It is echoed in travel-load-more-container.


								while( have_posts() ): the_post(); 
									get_template_part( 'template-parts/content', get_post_format() );//template-part - folder where are all the content files. get-template-part function will search a folder template-parts and files with start content- .
									// get_post_format() - retrieve the_post_format of the current post that is in the post loop.

								$i++; 
								endwhile; 

							echo '</div>';//if user clicked on LOAD MORE button, then goes to other page and whants to click back. Whith this code the user do not need to press LOAD MORE button again.
							?>


							<div class="col-lg-12 col-md-12 col-sm-12 pagination-item text-center">
								<?php 
								echo paginate_links(); // WP built in function
								?>
							</div><!-- .col-lg-12 -->

						<?php
						else:

						echo '<p>No content found</p>';

						endif;
						wp_reset_query();
					?>
					</div><!-- .col-lg-8 -->

				</div><!-- .row -->
			</div><!-- .container -->



		</section>
	</main>
</div><!-- #primary-home -->


<?php get_footer(); ?>