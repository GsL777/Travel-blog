<?php 

/* 
	@package Travel-blog-theme 
*/

get_header(); ?>


    <div id="primary-contact" class="content-contact">
        <main id="main-contact" class="site-contact" role="main">

            <section class="contact">
                <div class="container">
                    <section class="section1 clearfix">
                        <div class="text-center">
                            <h1>Drop Me a Mail</h1>
                        </div><!-- .textcenter -->
                    </section>
                
                    <section class="section2 clearfix">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 column1 first map">

                            <?php 
                                $args = array(
                                    'post_type'         => 'solutions',
                                    'order'             => 'ASC',
                                    'posts_per_page'    => 1,
                                    'tax_query' => array(
                                        array(
                                            'taxonomy'  => 'field',//custom taxonomy name written in category http field (as example: http://localhost/architecture/wp-admin/term.php?taxonomy=field&). In this case Wp dashboard->Projects->Field->Press on the category....
                                            'field'     => 'slug',
                                            'terms'     => array('Map'), //About - category name
                                        ),
                                    ),//on custom taxonomies if you could not print one or several categories use tax_query 
                                );

                                $blogLoop = new WP_Query($args);

                                if( $blogLoop->have_posts() ):
                                    
                                    while( $blogLoop->have_posts() ): $blogLoop->the_post(); 

                                        the_content();
                                        // get_template_part( 'template-parts/content', 'aside' );

                                    endwhile;
                                endif;

                                wp_reset_postdata(); //ensures that the global $post has been restored to the current post in the main query. (USE immediately after every custom WP_Query()).

                                //wp_reset_query() - ensure that the main query has been reset to the original main query. (USE wp_reset_query() - immediately after every loop using query_posts()).
                            ?>

                            </div><!-- .col-lg-6 -->
                            
                            <div class="col-lg-6 col-md-6 col-sm-12 column2 contact-section">
                                <div class="inner-content">
                                    <div class="address">
                                        <p>Lithuania, Kaunas</p>
                                        <p><span class="contacts">Phone :</span> +370 612345678</p>
                                        <p><span class="contacts">Email :</span> email@gmail.com</p>
                                    </div><!-- .address -->
                                </div><!-- .inner-content -->
                                <div class="contact-form">


								<?php 
									$args = array(
										'page_id'	=> '33'
									);

									$lastBlog = new WP_Query($args);

									if( $lastBlog->have_posts() ):
										
										while( $lastBlog->have_posts() ): $lastBlog->the_post();

											// get_template_part('template-parts/content', 'page');
								?>

											<article id="post-<?php the_ID(); ?>" class="<?php post_class(); ?>">
												<div class="entry-content">
													<?php the_content(); ?>
												</div><!-- .entry-content -->
											</article>

								<?php 
										endwhile;

									endif;

									wp_reset_postdata();
								?>

                                </div><!-- .contact-form -->

                            </div><!-- .col-lg-6 -->
                        </div><!-- .row -->
                    </section>
                </div><!-- .container-style -->
            </section>

        </main>
    </div><!-- #primary-contact -->


<?php get_footer(); ?>