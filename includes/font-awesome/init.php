<?php

/*
 *   CPAR WEBSITE: Includes (Font Awesome)
 *
 *   Author:     Carl A. Parker
 *   Website:    https://CarlParker.dev
*/

if ( ! defined( 'ABSPATH' ) ) : exit; endif; // SILENCE IS GOLDEN


/*
 *   ENQUEUE ASSETS
 *   enqueue feature when helper function is called
*/

     add_action( 'wp_enqueue_scripts', 'cpar_fontawesome_enqueue' );

     function cpar_fontawesome_enqueue() {

          // SITE KIT ID

          $siteKitID = 'XXXXXXXXX'; // enter site kit id here

          // ENQUEUE

          wp_enqueue_script(

               'CPar Website (Font Awesome)',
               'https://kit.fontawesome.com/'. $siteKitID .'.js',
               array( 'jquery' ),
               '',
               true

          );

          // ADD ATTRIBUTE - CROSS ORIGIN

          add_filter( 'script_loader_tag', 'cpar_fontawesome_crossorigin', 10, 3 );

          function cpar_fontawesome_crossorigin( $tag, $handle, $source ) {

               if ( 'CPar Website (Font Awesome)' === $handle ) :

                    $tag = '<script id="'. $handle .'" src="' . $source . '" crossorigin="anonymous"></script>';

               endif;

               return $tag;

          }

     }