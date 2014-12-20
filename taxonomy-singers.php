<?php


remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

add_action( 'genesis_entry_header', 'kjc_post_title' );
add_action( 'genesis_after_loop', 'kjc_related_posts' );
add_action( 'genesis_before_content', 'kjc_singer' );

function kjc_singer() {
$terms = get_the_terms( $post->ID , 'singers' );
	// Loop over each item since it's an array
	if ( $terms != null ){
			foreach( $terms as $term ) {
			// Print the name method from $term which is an OBJECT
			echo '<h2 class="singer entry-title">' . $term->name .'</h2>' ;
			// Get rid of the other data stored in the object, since it's not needed
			unset($term);
		} 
	} 
}

function kjc_post_title() {
	echo '<h2 class="entry-title" itemprop="headline">' . get_the_title() . '</h2>';
	the_content();
}

function kjc_related_posts() {
	echo do_shortcode('[shareaholic app="share_buttons" id="7305683"]');
	echo '<section class="related-posts">';
	echo '<h4 class="post-title">You might also want to check:</h4>';
	echo '<ul class="lists-of-singers">';
	$custom_terms = get_terms('singers');
	foreach($custom_terms as $custom_term) {
	    
	    wp_reset_query();

	    $term_link = get_term_link( $custom_term );

	    $args = array(
		    	'orderby' => 'rand',
	    		'post_type' => 'kingdom-musics',

	        'tax_query' => array(
	            array(
	                'taxonomy' => 'singers',
	                'field' => 'slug',
	                'terms' => $custom_term->slug,
	            )
	        ),
	    );
	    
	     $loop = new WP_Query( array( $args ));
	     if($loop->have_posts()) {
	     	
	     	?>
	     	
				<li class="related-singer"><a href="<?php echo esc_url( $term_link ); ?>" title="<?php echo $custom_term->name ?>"><?php echo $custom_term->name ?></a></li>
				
	     	<?php
		        // echo '<a href="'. esc_url( $term_link ) .'"><h1 class="entry-title">'.$custom_term->name.'</h1></a>';
	        // echo '</article>';
	    }
	}
	echo '</ul>';
	echo '</section>';
}


genesis();