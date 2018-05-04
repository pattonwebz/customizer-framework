/**
 * A script for handling theme customizer javascript actions.
 *
 * This script and incorporates code from Justin Tadlock's
 * TRT-Customizer-Pro: https://github.com/justintadlock/trt-customizer-pro.
 * Used under GPLv2 licence - 2016 © Justin Tadlock.
 *
 * @package   PattonWebz_Customize
 * @since     1.0.0
 * @author    William Patton <will@pattonwebz.com>
 * @copyright Copyright (c) 2018, William Patton
 * @link      https://github.com/pattonwebz/customizer-framework/
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

( function( api ) {

	// Extends our custom "example-1" section.
	api.sectionConstructor['pattonwebz-customizer-section-help'] = api.Section.extend( {

		// Bind a custom click handler for this section.
		attachEvents: function () {
			var section = this;

			// this is a horrible workaround to get html contend displayed in the panel.
			section.container.find( 'div.info' ).html( section.container.find( 'div.info' ).text() );

			if ( section.container.hasClass( 'cannot-expand' ) ) {
					return;
			}

			// Expand/Collapse accordion sections on click.
			section.container.find( '.accordion-section-title, .customize-section-back' ).on( 'click keydown', function( event ) {
				if ( api.utils.isKeydownButNotEnterEvent( event ) ) {
						return;
				}
				// if this click is NOT on the button do the click action ELSE the button will do default action.
				if ( String( event.srcElement.className ).indexOf( 'button button-primary' ) === -1 ) {
					event.preventDefault();
					// open up the info panel.
					section.container.find( 'div.info' ).slideToggle( 450, 'swing', add_or_remove_active(
						document.getElementById( 'accordion-section-' + section.id )
					));
				}

			});

		},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );

/**
 * Add or remove classnames from items based on a containing items display property.
 *
 * TODO: remove need for jQuery
 */
function add_or_remove_active( el ){
	if ( jQuery( el ).find( 'div.info' ).css( 'display' ) === 'none' ) {
		jQuery( el ).addClass( 'active' );
	} else {
		jQuery( el ).removeClass( 'active' );
	}
}
