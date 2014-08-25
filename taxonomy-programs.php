<?php


remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
// remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

// add_action( 'genesis_entry_header', 'kjc_post_title' );
// add_action( 'genesis_after_loop', 'kjc_related_posts' );
add_action( 'genesis_before_content', 'kjc_program' );
add_action( 'genesis_entry_header', 'kjc_thumbnail', 5 );

function kjc_program() {
$terms = get_the_terms( $post->ID , 'programs' );
	// Loop over each item since it's an array
	if ( $terms != null ){
			foreach( $terms as $term ) {
			// Print the name method from $term which is an OBJECT
			echo '<h2 class="program entry-title" itemprop="headline">' . $term->name .'</h2>' ;
			// Get rid of the other data stored in the object, since it's not needed
			unset($term);
		} 
	} 
}

function kjc_post_title() {
	echo '<h2 class="entry-title" itemprop="headline">' . get_the_title() . '</h2>';
	the_content();
}

function kjc_thumbnail() {
	echo genesis_get_image();
}

genesis();