/**
 * File detection.js.
 *
 * If this script loads, and executes, then JavaScript is allowed.
 * Just toggle the js class.
 */
'use strict';
(function() {
    const html = document.documentElement;
    if ( html.classList.contains('no-js') ) {
        html.classList.toggle( 'js' );
        html.classList.toggle( 'no-js' );
    } 
})();