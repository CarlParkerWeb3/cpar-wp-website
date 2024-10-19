<?php

/*
 *   CPAR WEBSITE: Helpers (Content Blocks)
 *
 *   Author:     Carl A. Parker
 *   Website:    https://CarlParker.dev
*/

if ( ! defined( 'ABSPATH' ) ) : exit; endif; // SILENCE IS GOLDEN


/*
 *    FUNCTION
 *    render content with blocks when called
*/

     function cpar_helper_content_blocks( $post_id ) {

          // GET META

          $post = get_post( $post_id );

          // FILTER CONTENT

          if ( $post ) {

               $the_content = apply_filters(

                    'the_content',
                    $post->post_content

               );

          }

          // DISPLAY IF CONTENT AVAILABLE

          if ( ! empty( $the_content ) ) { echo $the_content; }

     }