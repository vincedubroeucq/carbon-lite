/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
'use strict';
( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.header-title' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.header-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.header-title, .header-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.header-title, .header-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.header-title, .header-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Typography options.
	wp.customize( 'carbon_lite_body_text_size', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).removeClass( 'small-body-text medium-body-text large-body-text' );
			$( 'body' ).addClass( to );
		} );
	} );
	wp.customize( 'carbon_lite_headings_size', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).removeClass( 'small-headings medium-headings large-headings huge-headings' );
			$( 'body' ).addClass( to );
		} );
	} );
	wp.customize( 'carbon_lite_icons_size', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).removeClass( 'small-icons medium-icons large-icons' );
			$( 'body' ).addClass( to );
		} );
	} );

	// Layout options.
	wp.customize( 'carbon_lite_header_size', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).removeClass( 'small-header standard-header' );
			$( 'body' ).addClass( to );
		} );
	} );
	wp.customize( 'carbon_lite_content_area_size', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).removeClass( 'small-content-area medium-content-area large-content-area' );
			$( 'body' ).addClass( to );
		} );
	} );
	wp.customize( 'carbon_lite_sidebar_position', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).removeClass( 'sidebar-left sidebar-right no-sidebar' );
			$( 'body' ).addClass( to );
		} );
	} );
	wp.customize( 'carbon_lite_footer_text', function( value ) {
		value.bind( function( to ) {
			$( '.site-info' ).html( to );
		} );
	} );
} )( jQuery );
