<?php
/*

	@package Travel-blog-theme

	==========================================
		IMAGE POST FORMAT
	==========================================

*/
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('travel-format-image'); ?>>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 style">

			<?php if( has_post_thumbnail() ): ?>

				<?php if( has_post_thumbnail() ):
					$urlImg = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
				endif; ?>

				<div class="images" style="background-image: url(<?php echo $urlImg; ?>);"></div><!-- .images -->

					<ul class="info">
                        <li>
                            <div class="calendar">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <?php the_time('F j, Y'); ?>
                            </div>
                        </li>
                        <li>
                            <a href="<?php esc_url(the_permalink()); ?>">
                                <i class="fa fa-comment"></i>
                                Comments
                            </a>

                        </li>
                    </ul>
                    
                    <?php the_title('<h3 class="img-title">', '</h3>'); ?>

                    <hr>
                    
                    <?php the_content(); ?>

                    <div class="wrapper">
                    	<a class="button-style" href="<?php esc_url(the_permalink()); ?>"><span><?php _e( 'Read More' ); ?></span></a>
                    </div><!-- .wrapper -->

			<?php else: ?>

                <?php the_title('<h3 class="img-title">', '</h3>'); ?>

                <hr>
                
                <?php the_excerpt(); ?>

                <div class="wrapper">
                    <a class="button-style" href="<?php esc_url(the_permalink()); ?>"><span><?php _e( 'Read More' ); ?></span></a>
                </div><!-- .wrapper -->

			<?php endif; ?>

        </div><!-- .col-lg-12 -->

	</article><!-- standard WordPress markup -->