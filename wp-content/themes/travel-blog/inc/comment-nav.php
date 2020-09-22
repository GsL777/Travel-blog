<nav class="comment-navigation" role="navigation">

	<!-- <h3><?php //esc_html_e( 'comment_navigation', 'travel-studio' ); ?></h3> -->

	<div class="row">

		<div class="col-sm-6 col-xs-12">

			<div class="post-link-nav">

				<span class="icon chevron-left" aria-hidden="true"></span> 

				<?php previous_comments_link( esc_html__( 'Older Comments', 'travel-studio' ) ) ?>

			</div><!-- .post-link-nav -->

		</div><!-- .col-sm-6 -->

		<div class="col-sm-6 col-xs-12 text-right">

			<div class="post-link-nav">

				<?php next_comments_link( esc_html__( 'Newer Comments', 'travel-studio' ) ) ?>

				<span class="icon chevron-right" aria-hidden="true"></span>

			</div><!-- .post-link-nav -->

		</div><!-- .col-sm-6 -->

	</div><!-- .row -->

</nav>