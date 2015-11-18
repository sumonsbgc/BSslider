<?php 

function theme_options_fields(){
	
	add_settings_section( 
		'bs_carousel_section', 
		'Bootstrap Slider Options',//$title, 
		'bs_slider_section_cb',//$callback, 
		'bsoptions.php'//$page 
	);

	add_settings_field( 
		'bs_carousel_interval',//$id, 
		'Carousel Interval Time',//$title, 
		'bs_indicator_interval_cb',//$callback, 
		'bsoptions.php',//$page, 
		'bs_carousel_section'//$section,
	);

	add_settings_field( 
		'bs_pause',//$id, 
		'Pause',//$title, 
		'bs_carouselpause_cb',//$callback, 
		'bsoptions.php',//$page, 
		'bs_carousel_section'//$section,
	);

	add_settings_field( 
		'bs_carousel_indicator',//$id, 
		'Carousel Indicator Button',//$title, 
		'bs_carouselIndicator_cb',//$callback, 
		'bsoptions.php',//$page, 
		'bs_carousel_section'//$section,
	);

	register_setting( 
		'bs_carousel_section',//$option_group, 
		'carouselOptions'//$option_name,
	);
}
add_action('admin_init','theme_options_fields');



function bs_slider_section_cb(){
	return;
}

function bs_indicator_interval_cb(){
	$optionValue = (array) get_option('carouselOptions');
	$interval = $optionValue['bs_carousel_interval'];
	echo "<pre>";
		print_r($optionValue);
	echo "</pre>";
	echo '<input type="text" name="carouselOptions[bs_carousel_interval]" class="regular-text" value="'.$interval.'" />';
	echo "<p>Write the time in miliseconds after when each image slides</p>";
}

function bs_carouselpause_cb(){
	$optionValue = (array) get_option('carouselOptions');
	$pause = $optionValue['bs_pause'];
	echo'<select name="carouselOptions[bs_pause]" id="default_role">';
		echo '<option selected="'.$pause.'" value="'.$pause.'">'.$pause.'</option>';
		echo '<option value="true">True</option>';
		echo '<option value="false">False</option>';
	echo'</select>';
	echo "<p>if you choose true and when you place your mouse on the slider your slider stop sliding.</p>";
}

function bs_carouselIndicator_cb(){
	$optionValue = (array)get_option('carouselOptions');
	$indicator = $optionValue['bs_carousel_indicator'];

	echo '<select name="carouselOptions[bs_carousel_indicator]">';
		echo'<option selected="'.$indicator.'" value="'.$indicator.'">'.$indicator.'</option>';
		echo'<option value="true">True</option>';
		echo'<option value="false">False</option>';
	echo '</select>';

	echo "<p>If You choose False, The buttons won't show on the slider</p>";
}



function theme_options_as_submenu(){
	add_submenu_page(
		'edit.php?post_type=slider', 
		'Slider Options',//$page_title, 
		'Slider Options',//$menu_title, 
		'manage_options',//$capability, 
		'bsoptions.php',//$menu_slug, 
		'theme_options_callback'//$function 
	);
}
add_action('admin_menu','theme_options_as_submenu' );


function theme_options_callback(){
	?>
		<div class="wrap">
			<h2>Bootstrap Slider</h2>
			<?php settings_errors(); ?>
			<form action="options.php" method="POST">
				<?php do_settings_sections('bsoptions.php'); ?>
				<?php settings_fields('bs_carousel_section'); ?>
				<?php submit_button(); ?>
			</form>
		</div>
	<?php
}

?>