<?php 

/* 
	@package Travel-blog-theme 
*/

get_header(); ?>


	<div id="primary-about" class="content-about">
		<main id="main-about" class="site-about" role="main">

			<section class="about">	
				<?php 
					$args = array(
						'post_type'			=> 'solutions',
						'order'				=> 'ASC',
						'posts_per_page'	=> 1,
						'tax_query' => array(
							array(
								'taxonomy'	=> 'field',//custom taxonomy name written in category http field (as example: http://localhost/architecture/wp-admin/term.php?taxonomy=field&). In this case Wp dashboard->Projects->Field->Press on the category....
								'field'		=> 'slug',
								'terms'		=> array('About'), //About - category name
							),
						),//on custom taxonomies if you could not print one or several categories use tax_query 
					);

					$blogLoop = new WP_Query($args);

					if( $blogLoop->have_posts() ):
						
						while( $blogLoop->have_posts() ): $blogLoop->the_post(); 

							get_template_part( 'template-parts/content', 'aside' );

						endwhile;
					endif;

					wp_reset_postdata(); //ensures that the global $post has been restored to the current post in the main query. (USE immediately after every custom WP_Query()).

					//wp_reset_query() - ensure that the main query has been reset to the original main query. (USE wp_reset_query() - immediately after every loop using query_posts()).
				?>
			</section>


            <section class="about2">
                <div class="container"> 
                    <div class="section2">
                        <h3 class="text-center">FAQ's</h3>
                        <div class="row">
                            <ul class="accordion col-lg-6 col-md-6">
								<?php 
									$args = array(
										'post_type'			=> 'solutions',
										'order'				=> 'ASC',
										'posts_per_page'	=> 4,
										'tax_query' => array(
											array(
												'taxonomy'	=> 'field',//custom taxonomy name written in category http field (as example: http://localhost/architecture/wp-admin/term.php?taxonomy=field&). In this case Wp dashboard->Projects->Field->Press on the category....
												'field'		=> 'slug',
												'terms'		=> array('FAQ'), //About - category name
											),
										),//on custom taxonomies if you could not print one or several categories use tax_query 
									);

									$blogLoop = new WP_Query($args);

									if( $blogLoop->have_posts() ):
										
										while( $blogLoop->have_posts() ): $blogLoop->the_post(); 

											get_template_part( 'template-parts/content', 'quote' );

										endwhile;
									endif;

									wp_reset_postdata(); //ensures that the global $post has been restored to the current post in the main query. (USE immediately after every custom WP_Query()).

									//wp_reset_query() - ensure that the main query has been reset to the original main query. (USE wp_reset_query() - immediately after every loop using query_posts()).
								?>
                            </ul>


                            <ul class="accordion col-lg-6 col-md-6">
								<?php 
									$args = array(
										'post_type'			=> 'solutions',
										'order'				=> 'ASC',
										'posts_per_page'	=> 4,
										'tax_query' => array(
											array(
												'taxonomy'	=> 'field',//custom taxonomy name written in category http field (as example: http://localhost/architecture/wp-admin/term.php?taxonomy=field&). In this case Wp dashboard->Projects->Field->Press on the category....
												'field'		=> 'slug',
												'terms'		=> array('FAQs'), //About - category name
											),
										),//on custom taxonomies if you could not print one or several categories use tax_query 
									);

									$blogLoop = new WP_Query($args);

									if( $blogLoop->have_posts() ):
										
										while( $blogLoop->have_posts() ): $blogLoop->the_post(); 

											get_template_part( 'template-parts/content', 'quote' );

										endwhile;
									endif;

									wp_reset_postdata(); //ensures that the global $post has been restored to the current post in the main query. (USE immediately after every custom WP_Query()).
								?>
                            </ul>
                        </div><!-- .row -->
                    </div><!-- .section2 -->
                </div><!-- .container -->
            </section>

		</main>
	</div><!-- #primary-about -->


<?php get_footer(); ?>