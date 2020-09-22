<?php
/*

	@package Travel-blog-theme 

	==========================================
		ASIDE POST FORMAT
	==========================================

*/
?>
<!-- aside post format is not related with html <aside></aside> tag. It's just a name. -->

<article id="post-<?php the_ID(); ?>" <?php post_class( array('travel-format-aside') ); //array() - for declaring multiple classes, but if there is one class than array word could be deleted.?>>
	<div class="container aside-container">
		<div class="row">

			<?php if( has_post_thumbnail() ): ?>

				<?php if( travel_get_attachment() ): //travel_get_attachment() function in theme-support.php
				//GO TO WP DASBOARD -> MEDIA -> SELECT LIST ICON ON THE LEFT AND UNATTACH ALL OF THE IMAGES. THAN GO TO POSTS -> SELECT A POST -> ADD MEDIA -> SELECT A PICTURE -> INSERT PHOTO -> MAKE SURE IT IS UNDER THE TEXT -> UPDATE. IF IT DOESN'T WORK REUPLOAD AN IMAGE.
				?>
				<div class="col-lg-6 col-md-6">
					<div class="images" style="background-image: url(<?php echo travel_get_attachment(); ?>);"></div>
				</div><!-- .col-lg-6 -->

				<div class="col-lg-6 col-md-6">
					<div class="content">
						<?php the_title('<h3>', '</h3>'); ?>
						<?php the_content(); ?>
					</div><!-- .content -->
				</div><!-- .col-lg-6 -->

				<?php endif;

			else: ?>

				<div class="col-lg-6 col-md-6">
					<div class="content">
						<?php the_excerpt(); ?>
					</div><!-- .content -->
				</div><!-- .col-lg-6 -->

			<?php endif; ?>

		</div><!-- .row -->
	</div><!-- .container -->

</article><!-- standard WordPress markup -->