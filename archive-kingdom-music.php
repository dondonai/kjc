<?php

add_filter( 'body_class', 'km_page' );
function km_page( $classes ) {
	$classes[] = 'kingdom-music';
	return $classes;
}

add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );


genesis();