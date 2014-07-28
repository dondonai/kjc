jQuery(document).ready( function( $ ) {

// Streaming
$( '.live-tv, .fa-times-circle' ).on( 'click', function( e ) {

		e.preventDefault();

		$('.streaming').slideToggle();
		$stream_height = $('.streaming').height();
		$offset = $('.streaming').offset().top;
		$('html, body').animate({scrollTop: $('.streaming').offset().top }, 'slow');
		
<<<<<<< HEAD
		// console.log( $offset );
=======
		console.log( $offset );
>>>>>>> ebb55318b96daecdfbe9574b620f112c1b50511d
		// alert( $stream_height );
		if( $stream_height > 1 ) {
			$('.streaming iframe').attr( 'src', '');
		} else {
			$('.streaming iframe').attr( 'src', 'http://smni.live-s.cdn.bitgravity.com:1935/content:cdn-live/smni/live/feed001?width=620&height=410&streamType=live&AutoPlay=true&ScrubMode=simple&BufferTime=1.5&AutoBitrate=off&scaleMode=letterbox&DefaultRatio=1.777778&LogoPosition=topleft&ColorBase=0&ColorControl=14277081&ColorHighlight=16777215&ColorFeature=14277081&selectedIndex=0');
		}

	});

// Sticky menu
$( window ).scroll( function () {
	
<<<<<<< HEAD
	var $nav_primary = $('.nav-primary'),
	$sticky = $('.menu-primary'),
	$nav_offset = $nav_primary.offset().top + $nav_primary.height(),
	$win_middle = $('.site-inner').height() / 2,
	$win_scrolltop = $( window ).scrollTop();

=======
	$nav_primary = $('.nav-primary');
	$sticky = $('.menu-primary');
	$nav_offset = $nav_primary.offset().top + $nav_primary.height();
	$win_middle = $('.site-inner').height() / 2;
	$win_scrolltop = $( window ).scrollTop();

	console.log( $win_middle );

>>>>>>> ebb55318b96daecdfbe9574b620f112c1b50511d
	if( $win_scrolltop >= $nav_offset ) {
		$sticky.addClass('sticky');
		// $backtotop.fadeIn( 'slow' );
	} else {
		$sticky.removeClass('sticky');
		// $backtotop.fadeOut();
	}

	if( $win_scrolltop >= $win_middle ) {
		$backtotop.fadeIn();
	} else {
		$backtotop.fadeOut();
	}
});

// Back to top
$('.site-inner').after('<i class="fa fa-chevron-circle-up fa-2x"></i>');
$backtotop = $('.fa-chevron-circle-up');
$backtotop.on( 'click', function() {
	$('html, body').animate({scrollTop: 0 }, 'slow');
});

<<<<<<< HEAD
// Remove current singer
var singer = $('.singer.entry-title').text();

$('.related-singer a').each(function() {
     if ($(this).text() == singer) {
         $(this).parent().remove();
     }
});


=======
>>>>>>> ebb55318b96daecdfbe9574b620f112c1b50511d
});