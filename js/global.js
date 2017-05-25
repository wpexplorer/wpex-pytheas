( function( $ ) {

	"use strict";

	// Scroll back to top
	function wpexScrollTop() {
		$( 'a.scroll-site-top' ).on( 'click', function() {
			$( 'html, body' ).animate( {
				scrollTop : 0
			}, 'normal' );
			return false;
		} );
	}

	// Scroll to comments
	function wpexCommentScroll() {
		$( '.comment-scroll a' ).click( function(event) {
			event.preventDefault();
			$( 'html,body' ).animate( {
				scrollTop : $( this.hash ).offset().top
				}, 'normal' );
		} )
		;
	}
	// Responsive navbar
	function wpexResponsiveNav() {
		if ( $.fn.slicknav!=undefined ) {
			$( '#site-navigation .dropdown-menu' ).slicknav( {
				appendTo         : '#navbar',
				label            : wpexvars.mobileMenuLabel,
				allowParentLinks : true
			} );
		}
	}

	// Filter toggle
	function wpexFilterToggle() {
		var taxToggle = $( 'ul.tax-archives-filter > li.browse > a' );
		taxToggle.on( 'touchstart', function() {
			$( this ).parent().children( 'ul' ).toggleClass( 'visible' );
			return false;
		} );
	}

	// Run functions on doc ready
	$( document ).ready( function() {
		wpexScrollTop();
		wpexCommentScroll();
		wpexFilterToggle();
		wpexResponsiveNav();
	} );

} )( jQuery );