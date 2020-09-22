<?php 

/* 
	@package Travel-blog-theme 
*/

get_header(); ?>


	<div id="primary-gallery" class="content-gallery">
		<main id="main-gallery" class="site-gallery" role="main">

            <section class="gallery">
                <div class="container">
                    <div class="row">

						<?php 
							$args = array(
								'type' => 'post',
								'order' => 'DESC',
								 'category_name'=> 'Gallery',
								 'posts_per_page' => 8
							);

							$blogLoop = new WP_Query($args);

							if( $blogLoop->have_posts() ):

								while( $blogLoop->have_posts() ): $blogLoop->the_post();

									get_template_part( 'template-parts/content', get_post_format() );

								endwhile;
							endif;

							wp_reset_postdata(); //ensures that the global $post has been restored to the current post in the main query. (USE immediately after every custom WP_Query()).
						?>

                    </div><!-- .row -->
                </div><!-- .container -->


			</section>
		</main>
	</div><!-- #primary-gallery -->


<?php get_footer(); ?>