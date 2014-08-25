<?php

add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'dd_custom_loop' );

function dd_custom_loop() {

	echo '<div class="home-featured"><div class="wrap">';

		// genesis_widget_area( 'home-slider', array(
		// 	'before' => '<div class="home-slider widget-area">',
		// 	'after' => '</div>'
		// ));
		echo '<div class="home-slider four-sixths first widget-area">';
			echo do_shortcode( '[royalslider id="1"]' );
		echo '</div>';

		genesis_widget_area( 'home-sections', array(
			'before' => '<div class="home-sections one-fourth widget-area">',
			'after' => '</div>'
		));

	echo '</div></div>';

	echo '<div class="streaming"><div class="wrap">';
	?>
		<div class="bitgravity four-sixths first">
			<i class="fa fa-times-circle" title="Close Streaming"></i>
			<iframe src="" scrolling=no frameborder=0 width="620" height="410"><a href="?width=620&height=410&streamType=live&AutoPlay=true&ScrubMode=simple&BufferTime=1.5&AutoBitrate=off&scaleMode=letterbox&DefaultRatio=1.777778&LogoPosition=topleft&ColorBase=0&ColorControl=14277081&ColorHighlight=16777215&ColorFeature=14277081&selectedIndex=0">Play</a></iframe>	
		</div>

	<?php			
		
	echo '<div class="call-to-action one-fourth">';

		genesis_widget_area( 'call-to-action', array(
			'before' => '<div class="opt-in widget-area">',
			'after' => '</div>'
		));

	echo '</div>'; // end of cta

	echo '</div></div>'; // end of streaming

}

genesis();