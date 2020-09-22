<?php 
/*
	@package Travel-blog-theme
*/

if( post_password_required() ){//check if the post is password protected
	return; //return will stop the execution of the script
}

//Files in single.php file, theme-support.php (activated in functions.php), comment-nav.php

?>

<div id="comments" class="comments-area">

	<?php 
		if( have_comments() ):
		//We have comments
	?>

		<h2 class="comment-title">
			<?php 
				printf(
					esc_html( _nx( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'travel-blog' ) ),//&ldquo - left double quote, &rdquo - right double quote, %1$s - dynamic number
					number_format_i18n( get_comments_number() ), 
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h2>

		<?php echo get_post_navigation();//function in theme-support.php and html in comment-nav.php ?>

		<ol class="comment-list">
			<!-- default function of wordpress to grab the list of comments that are inside the single post -->
			<?php 
				$args = array(
					'walker'			=> null,
					'max_depth' 		=> '',//comment indentation (max 3 levels of comments in this case)
					'style'				=> 'ol',//ol - number list
					'callback'			=> null,//layout generating comment customization
					'end-callback'		=> null,//gets called at the generation of the single comment (could run an array, an animation)
					'type'				=> 'all',//type of comment we whant to print. There are 3 types: Trackbacks, ping back, pings.
					'reply_text'		=> 'Reply',//small link appears at the end of the comment
					'page'				=> '',//we can specify which page we whant to print on the comment list. Can limit comments to specific nuber of pages, example page 1
					'per_page'			=> '',//how many items per page we whant to show. In this case leave '' that user can manage everything by himself
					'avatar_size'		=> 64,//by default wp has type of avatar section in comment section. (goes from 0 to 512)
					'reverse_top_level' => null,//if set on null display most recent comment first, if whant to revert order write true.
					'reverse_children'	=> '',//reverse the order how wp prints the comments, but it affects the children
					'format'			=> 'html5',//by default html5. customize list format
					'short_ping'		=> false,//false - set by default. Boolean parameter, it gives ability to specify if we whant a regular or short ping. Ping - the way the html process this type of form
					'echo'				=> true//wp_list_comment print all the comments
				);

				wp_list_comments( $args );
			 ?>

		</ol>

		<?php echo get_post_navigation();//function in theme-support.php and html in comment-nav.php ?>

		<?php 
			if( !comments_open() && get_comments_number() ):
		?>

				<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'travel-blog' ); //second parameter - text domain?></p>

		<?php endif; ?>

	<?php 
		endif;
	?>

	<?php 

		$fields = array(
			'author' =>
				'<div class="form-group"><label for="author">' . __( 'Name', 'domainreference' ) . '</label> <span class="required">*</span> <input id="author" name="author" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) . '" required="required" /></div>',
			'email' =>
				'<div class="form-group"><label for="email">' . __( 'Email', 'domainreference' ) . '</label> <span class="required">*</span><input id="email" name="email" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" required="required" /></div>',
			'url' =>
				'<div class="form-group last-field"><label for="url">' . __( 'Website', 'domainreference' ) . '</label><input id="url" name="url" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></div>',

		);//variable for input fields

		$args = array(
			'class_submit'	=> 'btn btn-block btn-lg form-submit-button text-center',//changing button style
			'label_submit'	=> __( 'Submit Comment' ), //changing button name
			'comment_field'	=>
				'<div class="form-group"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label> <span class="required">*</span><textarea id="comment" class="form-control" name="comment" rows="4" required="required"></textarea></p>',
			'fields'		=> apply_filters( 'comment_form_default_fields', $fields )
		);

		comment_form( $args ); 

	?>

</div><!-- .comments-area -->