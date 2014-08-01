jQuery(document).ready( function( $ ) {

$('.menu-primary > .menu-item:last-child').after('<div class="responsive-menu"><i class="fa fa-navicon"></i></div>');
$('.responsive-menu').on('click', function() {
	$('.menu-primary .menu-item a').slideToggle();
});
// Streaming
$( '.live-tv, .fa-times-circle' ).on( 'click', function( e ) {

		e.preventDefault();

		$('.streaming').slideToggle();
		$stream_height = $('.streaming').height();
		$offset = $('.streaming').offset().top;
		$('html, body').animate({scrollTop: $('.streaming').offset().top }, 'slow');
		
		// console.log( $offset );
		// alert( $stream_height );
		if( $stream_height > 1 ) {
			$('.streaming iframe').attr( 'src', '');
		} else {
			$('.streaming iframe').attr( 'src', 'http://smni.live-s.cdn.bitgravity.com:1935/content:cdn-live/smni/live/feed001?width=620&height=410&streamType=live&AutoPlay=true&ScrubMode=simple&BufferTime=1.5&AutoBitrate=off&scaleMode=letterbox&DefaultRatio=1.777778&LogoPosition=topleft&ColorBase=0&ColorControl=14277081&ColorHighlight=16777215&ColorFeature=14277081&selectedIndex=0');
		}

	});

// Sticky menu
$( window ).scroll( function () {
	
	var $nav_primary = $('.nav-primary'),
	$sticky = $('.menu-primary'),
	$nav_offset = $nav_primary.offset().top + $nav_primary.height(),
	$win_middle = $('.site-inner').height() / 2,
	$win_scrolltop = $( window ).scrollTop();

	if( $win_scrolltop >= $nav_offset ) {
		$sticky.addClass('sticky');
		$('.menu-primary .menu-item a').hide();
		$('.genesis-nav-menu').css('line-height', '0');
		$('.responsive-menu').show();
	} else {
		$sticky.removeClass('sticky');
		$('.menu-primary .menu-item a').fadeIn();
		$('.genesis-nav-menu').css('line-height', '1');
		$('.responsive-menu').hide();
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

// Remove current singer
var singer = $('.singer.entry-title').text();

$('.related-singer a').each(function() {
     if ($(this).text() == singer) {
         $(this).parent().remove();
     }
});


});