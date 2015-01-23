
jQuery(document).ready( function( $ ) {

$('.site-header').backstretch( templateDir + "/images/bg.jpg");
// $.backstretch( "http://www.kingdomofjesuschrist.org/wp-content/uploads/2015/01/KICT-2015-Jan.jpg" );
$.backstretch( templateDir + "/images/KICT-2015-Jan.jpg" );


$('.site-header').after('<div class="navicon"><i class="fa fa-navicon"></i></div>');
$('.responsive-menu').on('click', function() {
	$('.menu-primary .menu-item a').slideToggle();
});
// Streaming
$( '.livetv a, .fa-times-circle' ).on( 'click', function( e ) {

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
			$('.streaming iframe').attr( 'src', 'http://smni.live-s.cdn.bitgravity.com:1935/content:cdn-live/smni/live/feed001?width=590&height=390&streamType=live&AutoPlay=true&ScrubMode=simple&BufferTime=1.5&AutoBitrate=off&scaleMode=letterbox&DefaultRatio=1.777778&LogoPosition=topleft&ColorBase=0&ColorControl=14277081&ColorHighlight=16777215&ColorFeature=14277081&selectedIndex=0');
		}

	});

// Sticky menu

var nav_secondary = $('.nav-secondary'),
	subnav_height = nav_secondary.height(),
	nav_height = $('.nav-primary').height(),
	header_wrap = $('.site-header .wrap');

$('.nav-secondary').css('top', '-' + subnav_height + 'px');

$( document ).scroll( function () {

	var nav_offset_top = header_wrap.height() + nav_height + 80;

	if($(window).scrollTop() > nav_offset_top) {
		sticky_nav_in();
	} else {
		sticky_nav_out();
	}

});

sticky_nav_in = function() {
	$('.nav-secondary').css({'top': '0', 'opacity': '.98'});
}
sticky_nav_out = function() {
	$('.nav-secondary').css({'top': '-' + subnav_height + 'px', 'opacity': '0'});
}

$('.navicon').on('click', function() {
	$('.nav-primary').fadeToggle();
});

	// Back to top
	$('.site-inner').after('<i class="fa fa-chevron-circle-up fa-2x"></i>');
	$backtotop = $('.fa-chevron-circle-up');
	$backtotop.on( 'click', function() {
		$('html, body').animate({scrollTop: 0 }, 'slow');
	});

	// Remove current singer
	var singer	= $('.singer.entry-title').text();


	$('.related-singer a, .entry-title a').each(function() {
		if($(this).text() == singer) $(this).parent().remove();
	});

	// Url fix for kingdom upclose
	$('#featured-page-4 a').attr('href', '/kjc/programs/kingdom-upclose/');

	var type_of_giving = $('.givings select').val();

	// $('.type-of-giving label').hide();

	$(type_of_giving).on( 'change', function() {

		$('.type-of-giving label').text( type_of_giving );
	});

	// setting iframe stardard size
	
	$('.footer-widgets section').addClass('one-sixth');
	$('.footer-widgets section:first-child').addClass('first');

	// $('.site-inner').before('<div class="greetings left"><img src="http://kojc.net/kojc/wp-content/uploads/2014/12/Greetings-Left.jpg" /></div>');

});