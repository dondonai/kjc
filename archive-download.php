<?php

add_filter( 'body_class', 'kjc_class' );
function kjc_class( $classes ) {
	$classes[] = "kjc-download";
	return $classes;
}

// add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

/** Replace the standard loop with our custom loop */
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'child_do_custom_loop' );

// add_action( 'genesis_loop', 'kjc_title', 1 );

function child_do_custom_loop() {

	global $paged; // current paginated page
	global $query_args; // grab the current wp_query() args
	$args = array(
		'post_type' => 'download',
		'showposts' => 18,
		// 'cat' => '1',
		// 'paged'     => $paged, // respect pagination
		// 'category_name'	=> 'download'
		// 'taxonomy' => 'category',
		// 'field' => 'slug'
	);

	genesis_custom_loop( wp_parse_args($query_args, $args) );

}

add_action( 'genesis_entry_content', 'kjc_download' ); // Replace default loop's content since it was removed
function kjc_download() {


	// the_field( 'download_link' );
	$link = get_field( 'download_link' );

	echo '<a href="'. $link . '" target="_blank">';
	echo the_post_thumbnail( 'download thumbnail' ) .'</a>';
}



genesis();