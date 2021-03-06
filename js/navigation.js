/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
'use strict';
( function() {
	var container, button, closeButton, menu, links, i, len;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button      = container.getElementsByTagName( 'button' )[0];
	closeButton = container.getElementsByTagName( 'button' )[1]; 
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	// Set event listeners.
	button.onclick = toggleMenu;
	closeButton.onclick = toggleMenu;
	window.onclick = closeMenu;
	document.onkeyup = closeMenuOnEsc;

	// Close the menu when the last focusable element is blurred
	const menuWrapper = document.querySelector( '.menu-wrapper' );
	const focusables = menuWrapper.querySelectorAll( 'a', 'select', 'input', 'button', 'textarea');
	const lastFocusable = focusables[focusables.length - 1];
	lastFocusable.onblur = toggleMenu;
	
	function toggleMenu(e) {
		
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};

	function closeMenu(e){
		var menuOpen      = -1 !== container.className.indexOf( 'toggled' ),
			buttonClicked = e.target == button || e.target.parentElement == button || e.target.parentElement.parentElement == button,
			menuWrapper   = document.getElementsByClassName( 'menu-wrapper' )[0],
			wrapperWidth  = menuWrapper.offsetWidth;

		if ( ! menuOpen ){
			return;
		}
		
		if ( buttonClicked ){
			return;
		}

		if ( e.clientX < ( window.innerWidth - wrapperWidth ) ){
			toggleMenu();
		}
	};

	function closeMenuOnEsc(e){
		var menuOpen      = -1 !== container.className.indexOf( 'toggled' );
		
		if ( ! menuOpen ){
			return;
		}
		
		if (e.key == "Esc" || e.keyCode == 27){
			toggleMenu();
		}
	}

	// Get all the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	( function( container ) {
		var touchStartFn, i,
			parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

		if ( 'ontouchstart' in window ) {
			touchStartFn = function( e ) {
				var menuItem = this.parentNode, i;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					e.preventDefault();
					for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
						if ( menuItem === menuItem.parentNode.children[i] ) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}
					menuItem.classList.add( 'focus' );
				} else {
					menuItem.classList.remove( 'focus' );
				}
			};

			for ( i = 0; i < parentLink.length; ++i ) {
				parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
			}
		}
	}( container ) );
} )();
