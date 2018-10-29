/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
    
    
    wp.customize( 'education_buz_theme_color', function( value ) {
		value.bind( function( theme_color ) {
			if(theme_color){
    		  var theme_color = '<style>' +
                  '#bm-go-top{background:'+theme_color+';}'+
                  '#top-site-navigation ul li a{color:'+theme_color+';}'+
                  '#masthead .social-links a{border-color:'+theme_color+';}'+
                  '.tnp-widget-minimal input.tnp-submit{background:'+theme_color+' !important;}'+
                  '</style>';
                  $('#dynamic-css').html(theme_color);
              }
		} );
	} );
    

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );
} )( jQuery );
