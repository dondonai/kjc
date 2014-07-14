jQuery(document).ready( function( $ ) {

// Streaming
$( '.live-tv, .fa-times-circle' ).on( 'click', function( e ) {

		e.preventDefault();

		$('.streaming').slideToggle();
		$stream_height = $('.streaming').height();
		$offset = $('.streaming').offset().top;
		$('html, body').animate({scrollTop: $('.streaming').offset().top }, 'slow');
		
		console.log( $offset );
		// alert( $stream_height );
		if( $stream_height > 1 ) {
			$('.streaming iframe').attr( 'src', '');
		} else {
			$('.streaming iframe').attr( 'src', 'http://smni.live-s.cdn.bitgravity.com:1935/content:cdn-live/smni/live/feed001?width=620&height=410&streamType=live&AutoPlay=true&ScrubMode=simple&BufferTime=1.5&AutoBitrate=off&scaleMode=letterbox&DefaultRatio=1.777778&LogoPosition=topleft&ColorBase=0&ColorControl=14277081&ColorHighlight=16777215&ColorFeature=14277081&selectedIndex=0');
		}

	});

// Sticky menu

$( window ).scroll( function () {
	
	$nav_primary = $('.nav-primary');
	$sticky = $('.menu-primary');
	$nav_offset = $nav_primary.offset().top + $nav_primary.height();
	$win_scrolltop = $( window ).scrollTop();

	if( $win_scrolltop >= $nav_offset ) {
		$sticky.addClass('sticky');
	} else {
		$sticky.removeClass('sticky');
	}
});

});