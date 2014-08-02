<?php

add_filter( 'body_class', 'kjc_class' );
function kjc_class( $classes ) {
	$classes[] = "manna-list";
	return $classes;
}

// remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
// remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
// remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

// remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
// remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
// remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

add_action( 'genesis_loop', 'kjc_title', 1 );

function kjc_title() {
	echo '<h2 class="entry-title">Manna</h2>';
}

genesis();