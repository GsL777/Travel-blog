<?php
/*

	@package Travel-blog-theme

	==========================================
		QUOTE POST FORMAT
	==========================================

*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'travel-format-quote' ); ?>>

	<li class="accordion-item">
		<input type="checkbox" checked>
		<i></i>
		<?php the_title('<h2>', '</h2>'); ?>
		<?php the_content(); ?>
	</li>

</article><!-- standard WordPress markup -->
