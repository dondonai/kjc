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
	// wp_enqueue_style( 'font-awesome', get_bloginfo( 'stylesheet_directory' ). '/css/font-awesome.min.css', array(), CHILD_THEME_VERSION );

	wp_enqueue_script( 'dd_scripts', get_bloginfo( 'stylesheet_directory' ). '/js/scripts.js', array( 'jquery' ), CHILD_THEME_VERSION );
	wp_enqueue_script( 'backstretch', '//cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js', array( 'jquery' ), CHILD_THEME_VERSION );
	// wp_enqueue_script( 'dd_history', get_bloginfo( 'stylesheet_directory' ). '/js/history.js', array( 'jquery' ), CHILD_THEME_VERSION );
	// wp_enqueue_script( 'dd_ajax', get_bloginfo( 'stylesheet_directory' ). '/js/ajax.js', array( 'jquery' ), CHILD_THEME_VERSION );


}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
// add_theme_support( 'genesis-footer-widgets', 3 );

add_image_size( 'download thumbnail', 100, 100, array( 'top', 'center' ) );

// Remove layouts
genesis_unregister_layout( 'sidebar-content' );
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

add_theme_support( 'genesis-structural-wraps', array(
	'header',
	// 'nav',
	// 'sub-nav',
	'site-inner',
	'footer-widgets',
	'footer'
));

add_filter('widget_text', 'do_shortcode');

// add_filter('genesis_footer_creds_text', 'dd_footer_creds_filter');
// function dd_footer_creds_filter( $creds ) {
// 	$creds = 'Copyright [footer_copyright] &middot; The Kingdom of Jesus Christ The Name Above Every Name &middot; All rights reserved.';
// 	return $creds;
// }
remove_action( 'genesis_footer', 'genesis_do_footer' );

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
// add_action( 'genesis_header', 'dd_header_left', 5 );
add_action( 'genesis_header', 'dd_header_right' );

function dd_header_left() {
	echo '<div class="header-left"><img src="'. get_bloginfo('stylesheet_directory') .'/images/kjc-logo.png" alt="KJC" class="header-left"></div>';
}

function dd_header_right() {
	echo '<div class="header-right"><img src="'. get_bloginfo('stylesheet_directory') .'/images/coat-of-arms-3d.png" alt="Coat of Arms" class="header-right"></div>';
}

// Register custom post types
add_action( 'init', 'dd_post_type' );
function dd_post_type() {

	// Kingdom Music
	register_post_type( 'kingdom-musics',
		array(
			'labels' => array(
				'name' => __( 'Musics' ),
				'singular_name' => __( 'Music' ),
				'add_new_item' => "Add New Music",
				'add_new' => "Add Music"
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'kingdom-music'),
			'supports' => array( 'title', 'editor', 'genesis-seo', 'thumbnail' ),
			'menu_icon' => 'dashicons-format-audio',
			'menu_position' => 5,
			// 'taxonomies' => array('post_tag', 'category'),
			'hierarchical' => false,
			// 'capability_type' => 'post',
			'yarpp_support' => true
		)
	);

	// Kingdom Videos
	register_post_type( 'kingdom-videos',
		array(
			'labels' => array(
				'name' => __( 'Videos' ),
				'singular_name' => __( 'Video' ),
				'add_new_item' => "Add New Video",
				'add_new' => "Add Video"
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'kingdom-video'),
			'supports' => array( 'title', 'editor', 'genesis-seo', 'thumbnail' ),
			'menu_icon' => 'dashicons-video-alt2',
			'menu_position' => 5,
			// 'taxonomies' => array('category', 'post_tag'),
			'hierarchical' => false,
			// 'capability_type' => 'post',
			'yarpp_support' => true
		)

	);

	// Downloads
	register_post_type( 'download',
		array(
			'labels' => array(
				'name' => __( 'Download' ),
				'singular_name' => __( 'Download' ),
				'add_new_item' => "Add New",
				'add_new' => "Add New"
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'download'),
			'supports' => array( 'title', 'editor', 'genesis-seo', 'thumbnail' ),
			'menu_icon' => 'dashicons-download',
			'menu_position' => 5,
			'taxonomies' => array('category'),
			'hierarchical' => true
		)
	);

	// Kingdom Upclose
	// register_post_type( 'kingdom-upclose',
	// 	array(
	// 		'labels' => array(
	// 			'name' => __( 'Upclose' ),
	// 			'singular_name' => __( 'Upclose' ),
	// 			'add_new_item' => "Add New Upclose",
	// 			'add_new' => "Add New Upclose"
	// 		),
	// 		'public' => true,
	// 		'has_archive' => true,
	// 		'rewrite' => array('slug' => 'kingdom-videos'),
	// 		'supports' => array( 'title', 'editor', 'genesis-seo', 'thumbnail' ),
	// 		'menu_icon' => 'dashicons-video-alt2',
	// 		'menu_position' => 5,
	// 		// 'taxonomies' => array('category', 'post_tag'),
	// 		'hierarchical' => true
	// 	)
	// );

	// Add new taxonomy

	// Singer taxonomy
	register_taxonomy( 'singers', array ( 'kingdom-musics', 'post' ),
		array( 
			'hierarchical' => true,
			'sort' => true,
			'args' => array('orderby' => 'term_order'),
			'rewrite' => array( 'slug' => 'singers' ),
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

	// Video taxonomy
	register_taxonomy( 'programs',array ( 'kingdom-videos', 'post' ),
		array( 
			'hierarchical' => true,
			'sort' => true,
			'args' => array('orderby' => 'term_order'),
			'rewrite' => array('slug' => 'programs' ),
			'label' => 'Programs',
			'show_ui' => true,
			'query_var' => true,
			'show_admin_column' => true,
			'labels' => array (
			  'search_items' => 'Program',
			  'add_new_item' => 'Add New Program'
			)
		) 
	);

}

add_action( 'genesis_before_footer', 'dd_custom_widget_footer' );
function dd_custom_widget_footer() {

	genesis_widget_area( 'footer-widgets', array(
		'before'	=> '<div class="footer-widgets widget-area"><div class="wrap">',
		'after'		=> '</div></div>'
	));

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

genesis_register_sidebar( array(
	'id' => 'footer-widgets',
	'name' => 'Footer Widgets',
	'description' => 'Footer widgets'
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

// add_action( 'genesis_entry_header', 'kjc_lang' );
function kjc_lang() {
	// echo do_shortcode( '[lang us="true" ukraine="true" japanese="true" chinese="true"]' );
	$link = get_the_permalink();
	$trimmed = rtrim( $link, '/' );
	$stylesheet = get_bloginfo( 'stylesheet_directory' );

	// substr_replace($link, '', -1);
	// substchar

	?>
		<div class="languages">
			<ul class="lang-list">
				<li class="lang-version"><a href="<?php echo mb_substitute_character( $link, ' ', -1 ); ?>" title="English"><img src="<?php echo $stylesheet; ?>/images/usa.png" alt="usa"></a></li>
				<li class="lang-version"><a href="<?php echo $trimmed . '-ukraine/'; ?>" title="Ukraine"><img src="<?php echo $stylesheet; ?>/images/ukraine.png" alt="usa"></a></li>
				<li class="lang-version"><a href="<?php echo $trimmed . '-japanese/'; ?>" title="Japanese"><img src="<?php echo $stylesheet; ?>/images/japan.png" alt="usa"></a></li>
				<li class="lang-version"><a href="<?php echo $trimmed . '-chinese/'; ?>" title="Chinese"><img src="<?php echo $stylesheet; ?>/images/china.png" alt="usa"></a></li>
				<li class="lang-version"><a href="<?php echo $trimmed . '-french/'; ?>" title="French"><img src="<?php echo $stylesheet; ?>/images/france.png" alt="usa"></a></li>
			</ul>
		</div>

	<?php
}

add_action( 'genesis_entry_header', 'kjc_languages', 12 );
function kjc_languages() {
	// echo do_shortcode( '[lang chinese french japanese="//devsites/kjc/trial-by-fire-japanese/" ukraine="//devsites/kjc/trial-by-fire-ukraine/" english="//devsites/kjc/trial-by-fire/"]' );
	echo do_shortcode('[google-translator]');
}

function lang_shortcode($atts){

	$stylesheet = get_bloginfo( 'stylesheet_directory' );
	extract(shortcode_atts(array(
	  'chinese' => '#',
	  'french' => '#',
	  'japanese' => '#',
	  'ukraine' => '#',
	  'english' => '#'
	), $atts));

   $return_string = '<ul class="lang-list">';
   
   if( strlen($chinese) > 2 ) $return_string .= '<li class="lang-version"><a href="'. $chinese .'"><img src="'. $stylesheet .'/images/china.png" alt=""></a></li>';   	

   if( strlen($french) > 2 ) $return_string .= '<li class="lang-version"><a href="'. $french .'"><img src="'. $stylesheet .'/images/france.png" alt=""></a></li>';

   if( strlen($japanese) > 2 ) $return_string .= '<li class="lang-version"><a href="'. $japanese .'"><img src="'. $stylesheet .'/images/japan.png" alt=""></a></li>';
   
   if( strlen($ukraine) > 2) $return_string .= '<li class="lang-version"><a href="'. $ukraine .'"><img src="'. $stylesheet .'/images/ukraine.png" alt=""></a></li>';
   
   if( strlen($english) > 2) $return_string .= '<li class="lang-version"><a href="'. $english .'"><img src="'. $stylesheet .'/images/usa.png" alt=""></a></li>';

   $return_string .= '</ul>';

   return $return_string;
}

add_shortcode('lang', 'lang_shortcode');

add_action( 'genesis_meta', 'dd_tempDir', 20 );
function dd_tempDir() {
	?>
	
	<script type="text/javascript">
		var templateDir = "<?php bloginfo('stylesheet_directory') ?>";
	</script>

	<?php
}

add_action( 'wp_head', 'cjfi_favicon');
function cjfi_favicon() {

	?>

	<link rel="shortcut icon" href="<?php bloginfo('url'); ?>/favicons/favicon.ico" type="image/x-icon" />
	<!-- Apple Touch Icons -->
	<link rel="apple-touch-icon" href="<?php bloginfo('url'); ?>/favicons/apple-touch-icon.png" />
	<link rel="apple-touch-icon" sizes="57x57" href="<?php bloginfo('url'); ?>/favicons/apple-touch-icon-57x57.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('url'); ?>/favicons/apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('url'); ?>/favicons/apple-touch-icon-114x114.png" />
	<link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('url'); ?>/favicons/apple-touch-icon-144x144.png" />
	<link rel="apple-touch-icon" sizes="57x57" href="<?php bloginfo('url'); ?>/favicons/apple-touch-icon-60x60.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('url'); ?>/favicons/apple-touch-icon-120x120.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('url'); ?>/favicons/apple-touch-icon-76x76.png" />
	<link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('url'); ?>/favicons/apple-touch-icon-152x152.png" />
	<!-- Windows 8 Tile Icons -->
    	<meta name="msapplication-square70x70logo" content="<?php bloginfo('url'); ?>/favicons/smalltile.png" />
	<meta name="msapplication-square150x150logo" content="<?php bloginfo('url'); ?>/favicons/mediumtile.png" />
	<meta name="msapplication-wide310x150logo" content="<?php bloginfo('url'); ?>/favicons/widetile.png" />
	<meta name="msapplication-square310x310logo" content="<?php bloginfo('url'); ?>/favicons/largetile.png" />


	<?php
}