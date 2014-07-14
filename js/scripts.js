jQuery(document).ready( function( $ ) {

	// $('.streaming').on( 'click', '.btn-stream', function(){
 //    $('.btn-stream').after('<div class="v-stream"><iframe src="http://smni.live-s.cdn.bitgravity.com:1935/content:cdn-live/smni/live/feed001?width=560&height=315&streamType=live&AutoPlay=true&ScrubMode=simple&BufferTime=1.5&AutoBitrate=off&scaleMode=letterbox&DefaultRatio=1.777778&LogoPosition=topleft&ColorBase=0&ColorControl=14277081&ColorHighlight=16777215&ColorFeature=14277081&selectedIndex=0" scrolling=no frameborder=0 width="560" height="315"><a href="?width=560&height=315&streamType=live&AutoPlay=true&ScrubMode=simple&BufferTime=1.5&AutoBitrate=off&scaleMode=letterbox&DefaultRatio=1.777778&LogoPosition=topleft&ColorBase=0&ColorControl=14277081&ColorHighlight=16777215&ColorFeature=14277081&selectedIndex=0">Play</a></iframe></div>');
	//   $('.v-stream').fadeIn();
	//   $('.v-stream iframe').after('<i class="fa fa-times-circle" title="Close window"></i>');
	// });
	// $('.streaming').on( 'click', '.fa-times-circle', function(){
	//     $('.v-stream').fadeOut( function() {
	//       $('.v-stream').remove();
	//     });
	// });
	
	// $('.fa-times-circle').on( 'click', function() {
	// 	$('.streaming').slideToggle();
	// });


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

});