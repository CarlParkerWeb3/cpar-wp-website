/*
 *   CPAR WEBSITE: Front-End Scripts
*/


/* -- PANELS -- */

jQuery( document ).ready( function( $ ) {

     if ( $( '[data-cpar-element^="panel"]' ).length ) {
alert('YES');
          // CONFIGS

          var panelSpeed = 375;

          // HELPER - CLOSE ACTIVE PANELS

          function cparPanels_close() {

               $( '[data-cpar-element^="panel"]:visible' ).stop().animate( { width: 'toggle' }, panelSpeed, 'linear' );

          }

          // ACTIONS - OPEN SPECIFIC PANEL ON CLICK

          $( '.cpar-panel-open, .cpar-panel-open a' ).click( function() {

               // GET HREF TARGET OF CLICKED LINK

               panelName = $( this ).attr( 'href' );

               // CLOSE ACTIVE PANELS

               cparPanels_close();

               // DISPLAY SELECTED PANEL

               $( panelName ).stop().delay( panelSpeed ).animate( { width: 'toggle' }, panelSpeed, 'linear' );

               // DISABLE BODY SCROLLING

               $( 'body' ).css( { 'overflow-y': 'hidden' } );

          } );

          // ACTIONS - CLOSE PANELS ON CLICK

          $( '.cpar-panel-close' ).click( function() {

               // HIDE PANELS

               $( '[data-cpar-element^="panel"]:visible' ).stop().animate( { width: 'toggle' }, panelSpeed, 'linear' );

               // ENABLE BODY SCROLLING

               $( 'body' ).css( { 'overflow-y': 'auto' } );

          } );

     }

} );