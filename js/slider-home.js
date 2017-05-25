( function( $ ) {

	"use strict";

	$( window ).load( function() {

		$( '#home-slider-loader' ).hide();

		flexLocalize.slideshow = ( flexLocalize.slideshow == 'true' ) ? true : false;
		flexLocalize.randomize = ( flexLocalize.randomize == 'true' ) ? true : false;

		$( '#home-slider.flexslider' ).flexslider({
			slideshow      : flexLocalize.slideshow,
			randomize      : flexLocalize.randomize,
			animation      : 'fade',
			slideshowSpeed : flexLocalize.slideshowSpeed,
			animationSpeed : flexLocalize.animationSpeed,
			smoothHeight   : true,
			controlNav     : true,
			prevText       : '<span class="fa fa-angle-left"></span>',
			nextText       : '<span class="fa fa-angle-right"></span>'
		} );

	} );

} ) ( jQuery );