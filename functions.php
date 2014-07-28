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
	// wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'font-awesome', get_bloginfo( 'stylesheet_directory' ). '/css/font-awesome.min.css', array(), CHILD_THEME_VERSION );

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

// Add logos on header
add_action( 'genesis_header', 'dd_header_left', 5 );
add_action( 'genesis_header', 'dd_header_right' );

function dd_header_left() {
	echo '<div class="header-left"><img src="'. get_bloginfo('stylesheet_directory') .'/images/kjc-logo.png" alt="KJC" class="header-left"></div>';
}

function dd_header_right() {
	echo '<div class="header-right"><img src="'. get_bloginfo('stylesheet_directory') .'/images/coat-of-arms.png" alt="Coat of Arms" class="header-right"></div>';
}

// Register custom post types
add_action( 'init', 'dd_kmusic_post_type' );
function dd_kmusic_post_type() {

	// Kingdom Music
	register_post_type( 'kingdom-musics',
		array(
			'labels' => array(
				'name' => __( 'Kingdom Musics' ),
				'singular_name' => __( 'Kingdom Music' ),
				'add_new_item' => "Add New KM",
				'add_new' => "Add New KM"
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'kingdom-musics'),
			'supports' => array( 'title', 'editor', 'genesis-seo', 'thumbnail' ),
			'menu_icon' => 'dashicons-format-audio',
			'menu_position' => 5,
			'taxonomies' => array('singer'),
			'hierarchical' => true
		)
	);

	// Kingdom Videos
	register_post_type( 'kingdom-videos',
		array(
			'labels' => array(
				'name' => __( 'Kingdom Videos' ),
				'singular_name' => __( 'Kingdom Video' ),
				'add_new_item' => "Add New KV",
				'add_new' => "Add New KV"
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'kingdom-videos'),
			'supports' => array( 'title', 'editor', 'genesis-seo', 'thumbnail' ),
			'menu_icon' => 'dashicons-video-alt2',
			'menu_position' => 5,
			// 'taxonomies' => array('category', 'post_tag'),
			'hierarchical' => true
		)
	);

	// Add new taxonomy

	// Singer taxonomy
	register_taxonomy( 'singers',array (
					  0 => 'kingdom-musics',
					),
		array( 'hierarchical' => true,
			'label' => 'Singers',
			'show_ui' => true,
			'query_var' => true,
			'show_admin_column' => true,
			'labels' => array (
			  'search_items' => 'Singer',
			  'add_new_item' => 'Add New Singer'
			)
		) 
	);

}

// Custom taxonomy
add_action('init', 'cptui_register_my_taxes_singers');
function cptui_register_my_taxes_singers() {}

// Register widgets
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

add_action('init', 'remove_editor_init');
function remove_editor_init() {
    // if post not set, just return 
    // fix when post not set, throws PHP's undefined index warning
    if (isset($_GET['post'])) {
        $post_id = $_GET['post'];
    } else if (isset($_POST['post_ID'])) {
        $post_id = $_POST['post_ID'];
    } else {
        return;
    }
    $template_file = get_post_meta($post_id, '_wp_page_template', TRUE);
    if ($template_file == 'singers.php') {
        remove_post_type_support('page', 'editor');
    }
}

add_action( 'genesis_after_sidebar_widget_area', 'kjc_ads');
function kjc_ads()  {
	if( is_tax( 'singers' ) ){
		echo "Check";
	}
}