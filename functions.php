<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'KOJC Theme' );
define( 'CHILD_THEME_URL', 'http://www.kingdomofjesuschrist.org/' );
define( 'CHILD_THEME_VERSION', '2.1.0' );

//* Enqueue Google Fonts
add_action( 'wp_enqueue_scripts', 'dd_google_fonts' );
function dd_google_fonts() {

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700|Oswald:300,400|Dosis:300,400|Droid+Serif:400,700|Open+Sans:400,300', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css', array(), CHILD_THEME_VERSION );

	wp_enqueue_script( 'dd_scripts', get_bloginfo( 'stylesheet_directory' ). '/js/scripts.js', array( 'jquery' ), CHILD_THEME_VERSION );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Unregister sidebar/content layout setting
genesis_unregister_layout( 'sidebar-content' );
 
//* Unregister content/sidebar/sidebar layout setting
genesis_unregister_layout( 'content-sidebar-sidebar' );
 
//* Unregister sidebar/sidebar/content layout setting
genesis_unregister_layout( 'sidebar-sidebar-content' );
 
//* Unregister sidebar/content/sidebar layout setting
genesis_unregister_layout( 'sidebar-content-sidebar' );

add_filter('widget_text', 'do_shortcode');

add_filter('genesis_footer_creds_text', 'dd_footer_creds_filter');
function dd_footer_creds_filter( $creds ) {
	$creds = '[footer_copyright first="2009"] &middot; The Kingdom of Jesus Christ The Name Above Every Name &middot; All rights reserved.';
	return $creds;
}

add_filter( 'comment_form_defaults', 'dd_custom_comment_form' );
function dd_custom_comment_form( $fields ) {
	$fields['comment_notes_before'] = '';
	$fields['comment_notes_after'] = '';
	unset( $fields['fields']['url']);
    return $fields;
}

// Remove un-used elements
unregister_sidebar( 'header-right' );
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

add_action( 'genesis_header', 'dd_header_left', 5 );
add_action( 'genesis_header', 'dd_header_right' );

function dd_header_left() {
	echo '<div class="header-left"><img src="'. get_bloginfo('stylesheet_directory') .'/images/kjc-logo.png" alt="KJC" class="header-left"></div>';
}

function dd_header_right() {
	echo '<div class="header-right"><img src="'. get_bloginfo('stylesheet_directory') .'/images/coat-of-arms.png" alt="Coat of Arms" class="header-right"></div>';
}

genesis_register_sidebar( array(
	'id' => 'home-slider',
	'name' => 'Home Slider',
	'description' => 'Home slider widget'
) );

genesis_register_sidebar( array(
	'id' => 'home-sections',
	'name' => 'Home Sections',
	'description' => 'Home sections widget'
) );

genesis_register_sidebar( array(
	'id' => 'call-to-action',
	'name' => 'Call to Action',
	'description' => 'Call to action widget'
) );