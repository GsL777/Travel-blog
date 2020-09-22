<!-- Custom Travel Theme Support on WordPress dashboard-->
<h1>Travel Theme Support</h1>

<?php settings_errors();//function that will print an error ?>

<form method="post" action="options.php" class="travel-general-form">
	<?php settings_fields( 'travel-theme-support' ); ?>
	<?php do_settings_sections('travel_website_theme');?>
	<?php submit_button(); ?>
</form>