<?php

add_filter( 'body_class', 'kjc_class' );
function kjc_class( $classes ) {
	$classes[] = "manna-list";
	return $classes;
}

add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

add_action( 'genesis_loop', 'kjc_title', 1 );

function kjc_title() {
	echo '<div class="manna-info"><h2 class="entry-title">Manna of Revelations</h2>
	<p>As preached by Pastor Apollo C. Quiboloy on his daily programs on Sonshine Media Network International (SMNI).</p>
	</div>';
}

add_action( 'genesis_entry_header', 'kjc_author', 1 );
function kjc_author() {
	echo do_shortcode( '[post_comments zero="0" one="1" more="%"]' );	
}

genesis();