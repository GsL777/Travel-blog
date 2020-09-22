<?php get_header(); ?>


<div class="single">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-xs-12 col-sm-4">
				<?php get_sidebar(); ?>
			</div><!-- .col-lg-4 -->

			<div class="col-lg-8 col-sm-8 col-xs-12">

				<?php 
					if(have_posts()):
						while(have_posts()): the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

								<?php the_title('<h1 class="entry-title">','</h1>' ); ?>

								<?php if(has_post_thumbnail() ): ?>
									<div class="pull-right"><?php the_post_thumbnail('thumbnail'); ?></div><!-- .pull-right -->
								<?php endif; ?>

								<small>
									<?php the_category(' '); ?> || <?php the_tags(); ?>
								</small>

								<div class="content">
									<?php the_content(); ?>
								</div><!-- .content -->

							<hr>

							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left navigation">
									<?php previous_post_link(); ?>
								</div><!-- .col-lg-6 -->
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right navigation">
									<?php next_post_link(); ?>
								</div><!-- .col-lg-6 -->
							</div><!-- .row -->

							<?php 
								if( comments_open() ) { 
									comments_template();//calls comments.php file
								}else{
									echo '<h5 class="text-center">Sorry, but your comments are not allowed!</h5>';
								}
							?>

							</article>
						<?php endwhile;
					endif;
				?>

			</div><!-- .col-sm-8 -->
			
		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- .single -->


<?php get_footer(); ?>