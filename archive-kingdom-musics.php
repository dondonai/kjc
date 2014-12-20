<?php

add_filter( 'body_class', 'km_page' );
function km_page( $classes ) {
	$classes[] = 'kingdom-musics';
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

add_action( 'genesis_loop', 'kjc_kingdom_musics' );
// add_action( 'genesis_after_loop', 'kjc_music_archive' );

function kjc_kingdom_musics() {
$custom_terms = get_terms('singers', array(
		'orderby' => 'id',
		'hide_empty' => 0
	));
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
	     	
	     	<article <?php post_class(); ?>>
	     		<a href="<?php echo esc_url( $term_link ); ?>" title="<?php echo $custom_term->name ?>">
		     		<img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/<?php $terms = get_terms('singers'); echo $custom_term->slug ?>.jpg" width="300" height="300" /> 
					<h1 class="entry-title"><?php echo $custom_term->name ?></h1>
				</a>
			</article>

	     	<?php
		        // echo '<a href="'. esc_url( $term_link ) .'"><h1 class="entry-title">'.$custom_term->name.'</h1></a>';
	        // echo '</article>';
	     }
	}
}

function kjc_music_archive() {
	// get the currently queried taxonomy term, for use later in the template file
	$terms = get_terms( 'singers', array(
	    'orderby'    => 'id',
	    'hide_empty' => 0
	) );

	// now run a query for each animal family
// now run a query for each animal family
foreach( $terms as $term ) {
 		
 		$term_link = get_term_link( $custom_term );
    // Define the query
    $args = array(
        'post_type' => 'kingdom-music',
        'singers' => $term->slug
    );
    $query = new WP_Query( $args );
             
    // output the term name in a heading tag                
    echo'<h2>' . $term->name . '</h2>';
     
    // output the post titles in a list
    echo '<ul>';
     
        // Start the Loop
        while ( $query->have_posts() ) : $query->the_post(); ?>
 
        <li class="animal-listing" id="post-<?php the_ID(); ?>">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </li>
         
        <?php endwhile;
     
    echo '</ul>';
     
    // use reset postdata to restore orginal query
    wp_reset_postdata();
 
}


}

genesis();