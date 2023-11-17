/* global wp, jQuery */
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

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					clip: 'auto',
					position: 'relative',
				} );
				$( '.site-title a, .site-description' ).css( {
					color: to,
				} );
			}
		} );
	} );
	// wp.customize.bind('ready', function() {
		
		wp.customize( 'section_home_section_setting_type_0', function( setting ) {
			console.log(123)
			
			// wp.customize.control( 'section_home_section_control_image_0', function( setting ) {
				
				// var visibility = function() {
				// 	if ( 'single' !== setting.get() ) {
				// 		control.container.slideDown( 180 );
				// 	} else {
				// 		control.container.slideUp( 180 );
				// 	}
				// };
				// visibility();
				// setting.bind( visibility );
			// });
		});
	
}( jQuery ) );

