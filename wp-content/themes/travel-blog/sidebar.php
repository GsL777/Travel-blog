<?php
/* 
	@package Travel-blog-theme 
*/

if( !is_active_sidebar( 'travel-sidebar' ) ){//travel-sidebar - id from theme-support.php travel_sidebar_init array
	return;//return null (nothing)
}//safety check if the sidebar is not active 
?>

<aside id="secondary" class="widget_area" role="complementary">

	<h3 class="popular-posts">Popular posts</h3>

	<?php 
		$args = array(
			'type'				=> 'post',
			'posts_per_page'	=> 3,
			// 'cat'				=> -14, //hides gallery category
			'orderby'			=> 'meta_value_num'
		);

		$lastBlog = new WP_Query($args);

		if( $lastBlog->have_posts() ):
			
			while( $lastBlog->have_posts() ): $lastBlog->the_post(); ?>

				<ul class="post-list">
					<li class="post-content">
						<a href="<?php esc_url(the_permalink()); ?>">
							<div class="images" style="background-image: url(<?php echo travel_get_attachment(); ?>);"></div><!-- .images -->
							<h4 class="img-title"><?php the_title(); ?></h4>
						</a>
					</li>
				</ul>
				
			<?php endwhile;
			
		endif;
		
		wp_reset_postdata();
	 ?>

	<?php dynamic_sidebar( 'travel-sidebar' ); //travel-sidebar - id from theme-support.php travel_sidebar_init array. header.php?>
</aside>