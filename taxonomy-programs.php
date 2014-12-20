<?php

add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

// add_action( 'genesis_loop', 'child_do_custom_loop' );
function child_do_custom_loop() {

	global $paged; // current paginated page
	global $query_args; // grab the current wp_query() args
	$args = array(
		'post_type' => 'kingdom-videos',
		'showposts' => -1, // exclude posts from this category
		// 'paged'     => $paged, // respect pagination
		// 'category_name'	=> 'victory-reports'
		'taxonomy'	=> 'programs',
		'terms'		=> 'powerline',
		'orderby'	=> 'rand'
	);

	genesis_custom_loop( wp_parse_args($query_args, $args) );
// add permalink();
	the_post_thumbnail();
	genesis_post_title();

}

// remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_entry_header', 'dd_tax_programs' );
function dd_tax_programs() {
<<<<<<< HEAD
	echo '<a href="'. get_the_permalink() .'" title="'. get_the_title() .'">';
		the_post_thumbnail();
	echo '</a>';
=======
	the_post_thumbnail();
>>>>>>> 722eac2add4b940a63e12813a1c3e119b726df98
	genesis_post_title();
}

add_action( 'genesis_after_loop', 'dd_check' );
function dd_check() {
	
}

/**
 * Add and extra class to the entry-content div
 *
 */
function dd_custom_class( $attributes ) {
  $attributes['class'] = $attributes['class']. ' one-third';
 return $attributes;
}
// add_filter( 'genesis_attr_entry', 'dd_custom_class' );

genesis();