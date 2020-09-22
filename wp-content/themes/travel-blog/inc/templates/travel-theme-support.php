<h1>Travel Theme Options</h1>
<?php settings_errors(); //function that will print an error?>

<form method="post" action="options.php" class="travel-general-form"> 

	<?php settings_fields( 'travel-theme-support' ); //Theme Options from function travel_custom_settings?>
	
	<?php do_settings_sections( 'travel_website_theme' );?>

	<?php submit_button(); //First parameter - text parameter of submit button. Second parameter - the type of the button. Third parameter - name will be used as an id. ?>
</form>
