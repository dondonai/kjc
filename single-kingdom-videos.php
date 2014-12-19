<?php


remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

// remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

// remove_action( 'genesis_loop', 'genesis_do_loop' );

// add_action( 'genesis_loop', 'genesis_do_post_content' );
// add_action( 'genesis_after_loop', 'child_do_custom_loop' );
function child_do_custom_loop() {

	echo '<div class="related-posts">';

	echo '<h1 class="widgettitle">You might also like to watch:</h1>';

	global $paged; // current paginated page
	global $query_args; // grab the current wp_query() args
	$args = array(
		'post_type' => 'kingdom-videos',
		// 'showposts' => 5, // exclude posts from this category
		'posts_per_page' => 5,
		// 'paged'     => 0, // respect pagination
		// 'orderby'	=> 'rand',
		// 'order'		=> 'rand',
		'taxonomy'	=> 'programs',
		// 'nopaging'	=> true
	);

	genesis_custom_loop( wp_parse_args($query_args, $args) );

	echo '</div>';
	
}


	


genesis();