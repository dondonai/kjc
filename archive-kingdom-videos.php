<?php

add_filter( 'body_class', 'km_page' );
function km_page( $classes ) {
	$classes[] = 'kingdom-videos';
	return $classes;
}

remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

remove_action( 'genesis_loop', 'genesis_do_loop' );

add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

add_action( 'genesis_loop', 'kjc_kingdom_videos' );

function kjc_kingdom_videos() {
$custom_terms = get_terms('programs', array(
		'orderby' => 'id',
		// 'order' => 'DESC',
		'hide_empty' => 0
	));
foreach($custom_terms as $custom_term) {
	    	
	    wp_reset_query();

	    $term_link = get_term_link( $custom_term );
	    $args = array(
		    	'orderby' => 'rand',
	    		'post_type' => 'kingdom-videos',
	        'tax_query' => array(
	            array(
	                'taxonomy' => 'programs',
	                'field' => 'slug',
	                'terms' => $custom_term->slug,
	            )
	        ),
	     );

	     $loop = new WP_Query( array( $args ));
	     if($loop->have_posts()) {
	     	
	     	?>
	     	
	     	<article <?php post_class(); ?>>
	     		<a href="<?php echo esc_url( $term_link ); ?>" title="<?php echo $custom_term->name ?>">
		     		<img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/<?php $terms = get_terms('programs'); echo $custom_term->slug ?>.jpg" width="300" height="300" /> 
					<h1 class="entry-title"><?php echo $custom_term->name ?></h1>
				</a>
			</article>

	     	<?php
	     }
	}
}

add_action( 'genesis_entry_header', 'kjc_author', 1 );
function kjc_author() {
	echo do_shortcode( '[post_comments zero="0" one="1" more="%"]' );
	echo genesis_get_image();
}


genesis();