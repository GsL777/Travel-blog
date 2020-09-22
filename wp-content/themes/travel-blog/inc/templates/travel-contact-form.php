<h1>Travel Contact Form</h1>
<?php settings_errors(); //function that will print an error?>

<p>Use this <strong>shortcode</strong> to activate the Contact Form inside a Page or Post</p>
<p><code>[contact_form]</code></p> <!-- shortcode in inc -> shortcodes.php -->

<form method="post" action="options.php" class="travel-general-form">

	<?php settings_fields( 'travel-contact-options' ); //Contact Form Options from function travel_custom_settings register_setting First parameter?>
	
	<?php do_settings_sections( 'travel_website_theme_contact' ); //Contact Form Options from function travel_custom_settings Fourth parameter?>

	<?php submit_button(); //First parameter - text parameter of submit button. Second parameter - the type of the button. Third parameter - name will be used as an id. ?>
</form>
