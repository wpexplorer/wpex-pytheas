( function( $ ) {

	"use strict";

	$( document ).ready( function() {

		var $lightboxTheme = lightboxLocalize.theme;

		$( ".prettyphoto-link" ).prettyPhoto( {
			animation_speed    : 'fast',
			theme              : $lightboxTheme,
			show_title         : false,
			social_tools       : false,
			slideshow          : false,
			autoplay_slideshow : false,
			wmode              : 'opaque'
		} );
		
		$( "a[rel^='prettyPhoto']" ).prettyPhoto( {
			animation_speed    : 'fast',
			theme              : $lightboxTheme,
			show_title         : false,
			social_tools       : false,
			autoplay_slideshow : false,
			overlay_gallery    : true,
			wmode              : 'opaque'
		} );

	} );

} ) ( jQuery );