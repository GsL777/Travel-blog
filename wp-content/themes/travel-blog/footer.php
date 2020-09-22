<?php 
	/*
		This is the template for the footer

		@package Travel-blog-theme
	*/
?>


    <footer class="footer pt-4">
        <div class="container text-center text-md-left">
            <div class="row">
                <div class="content col-lg-3 col-md-4">
                    <h5 class="font-weight-bold text-uppercase mb-4">About</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit amet numquam iure provident voluptate esse quasi, veritatis totam voluptas nostrum.</p>
				</div><!-- .content -->


                <div class="links col-lg-2 col-md-2">
                    <h5 class="font-weight-bold text-uppercase mb-4">Links</h5>
					<?php 
						wp_nav_menu(
							array(
								'theme_location'	=> 'secondary',//theme_location - has to be the same name as specified in functions.php (register_nav_menu (first value - string $location)).
								'menu_class'		=> 'list-unstyled'
							)
						);
					?>
                </div><!-- .links -->

            
                <div class="address col-lg-3 col-md-4">
                    <h5 class="font-weight-bold text-uppercase mb-4">Address</h5>

                    <ul class="list-unstyled">
                        <li>
                            <p><i class="fa fa-home mr-3"></i> London, UK</p>
                        </li>
                        <li>
                            <p><i class="fa fa-envelope mr-3"></i> mail@example.com</p>
                        </li>
                        <li>
                            <p><i class="fa fa-phone mr-3"></i> + 01 234 567 89</p>
                        </li>
                    </ul>
                </div><!-- .address -->


                <div class="socials col-lg-2 col-md-2 text-center">
                    <h5 class="font-weight-bold text-uppercase mb-4">Follow</h5>

                    <div class="container">
                    	<?php echo footer_social_btn(); //footer social function in theme-support.php ?>
                    </div><!-- .container -->

                </div><!-- .socials -->
            </div><!-- .row -->
        </div><!-- .container -->


        <!-- cookie place -->


        <div class="footer-copyright text-center py-3">&copy; 2020 - <?php echo year(); ?> Copyright</div>

    </footer>

	<?php wp_footer(); ?>
	</body>
</html>