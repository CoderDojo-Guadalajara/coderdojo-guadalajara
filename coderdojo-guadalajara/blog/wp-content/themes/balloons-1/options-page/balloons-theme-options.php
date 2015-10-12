<?php
/**
 *
 * Credits: http://wp.tutsplus.com/tutorials/using-the-settings-api-part-1-create-a-theme-options-page/
 *
 * Define our settings sections
 *
 * array key=$id, array value=$title in: add_settings_section( $id, $title, $callback, $page );
 * @return array
 */
function balloons_options_page_sections() {
	
	$sections = array();
	// $sections[$id] 				= __($title, 'balloons_textdomain');
	$sections['language'] 			= __('Language', 'balloons_textdomain');
	$sections['site-title'] 		= __('Site Title', 'balloons_textdomain');
	$sections['color'] 				= __('Color', 'balloons_textdomain');
	return $sections;	
}


/**
 * Define our form fields (settings) 
 *
 * @return array
 */
function balloons_options_page_fields() {


	// Language
	$options[] = array(
		"section" => "language",
		"id"      => BALLOONS_SHORTNAME . "_select-language",
		"title"   => __( 'Choose your frontend language', 'balloons_textdomain' ),
		"type"    => "select",
		"std"    => "English",
		"choices" => array( "English", "Deutsch")
	);
	


	// Site title
	$options[] = array(
		"section" => "site-title",
		"id"      => BALLOONS_SHORTNAME . "_site-title_line1",
		"title"   => __( 'Line 1', 'balloons_textdomain' ),
		"type"    => "text",
		"std"     => __('1','balloons_textdomain')
	);

	$options[] = array(
		"section" => "site-title",
		"id"      => BALLOONS_SHORTNAME . "_site-title_line2",
		"title"   => __( 'Line 2', 'balloons_textdomain' ),
		"desc"    => __( 'If you want to leave the title blank, insert non-breaking spaces <span style="font-style: normal;">&amp;nbsp;</span> to the inputs fields.', 'balloons_textdomain' ),
		"type"    => "text",
		"std"     => __('2','balloons_textdomain')
	);


	// Color
	$options[] = array(
		"section" => "color",
		"id"      => BALLOONS_SHORTNAME . "_color",
		"title"   => __( 'Choose your link color', 'balloons_textdomain' ),
		"desc"    => __( 'Default color: <span style="font-style: normal;">#3cb5c7</span>', 'balloons_textdomain' ),
		"type"    => "text",
		"std"     => __('#3cb5c7','balloons_textdomain')
	);

	$options[] = array(
		"section" => "color",
		"id"      => BALLOONS_SHORTNAME . "_color-hover",
		"title"   => __( 'Choose your link hover color', 'balloons_textdomain' ),
		"desc"    => __( 'Default color: <span style="font-style: normal;">#80c3cd</span>', 'balloons_textdomain' ),
		"type"    => "text",
		"std"     => __('#80c3cd','balloons_textdomain')
	);
	
	$options[] = array(
		"section" => "color",
		"id"      => BALLOONS_SHORTNAME . "_selection",
		"title"   => __( 'Choose your text selection background color', 'balloons_textdomain' ),
		"desc"    => __( 'Default color: <span style="font-style: normal;">#bedfe1</span>', 'balloons_textdomain' ),
		"type"    => "text",
		"std"     => __('#bedfe1','balloons_textdomain')
	);


	return $options;	
}



/**
 * Contextual Help
 */
function balloons_options_page_contextual_help() {
	
	$text 	= "<h3>" . __('Balloons Settings - Contextual Help','balloons_textdomain') . "</h3>";
	$text 	.= "<p>" . __('Contextual help goes here. You may want to use different html elements to format your text as you want.','balloons_textdomain') . "</p>";
	
	// must return text! NOT echo
	return $text;
} ?>