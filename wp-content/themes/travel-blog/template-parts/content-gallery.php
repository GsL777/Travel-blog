<?php
/*

	@package Travel-blog-theme

	==========================================
		GALLERY POST FORMAT
	==========================================

*/
?>

<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 gallery-style"><!-- style in index.scss -->
	<article id="post-<?php the_ID(); ?>" <?php post_class('travel-format-gallery'); ?>>
		<?php if( travel_get_attachment() ): //travel_get_attachment() function in theme-support.php?>
			    <div class="gallery-content">
			        <div class="gallery-img">
			            <div class="images" style="background-image: url(<?php echo travel_get_attachment(); ?>);"></div><!-- .images -->
			        </div><!-- .gallery-img -->
			        <div class="content">
			            <h3 class="name"><?php the_content(); ?></h3>
			            <span class="post"><?php the_excerpt(); ?></span>
			        </div><!-- .content -->
			    </div><!-- .gallery-content -->
		<?php endif; ?>
	</article><!-- standard WordPress markup -->
</div><!-- .col-lg-6 -->