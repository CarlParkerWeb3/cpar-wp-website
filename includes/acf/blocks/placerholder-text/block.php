<?php

/*
 *   CPAR WEBSITE: Block (Placeholder Text)
 *
 *   Author:     Carl A. Parker
 *   Website:    https://CarlParker.dev
*/

if ( ! defined( 'ABSPATH' ) ) : exit; endif; // SILENCE IS GOLDEN


/*
 *   TEMPLATE
 *   callback function to render front-end display and back-end preview
*/

     function cpar_blocks_placeholderText_template( $block, $post_id, $is_preview ) {

          // CONFIGURE SETTINGS

          $cparBlockATTR = cpar_acf_blocks_setup( $block, $post_id, $is_preview );

          // DISPLAY CONDITIONAL

          if ( $is_preview ) : // BACK-END

               cpar_acf_blocks_preview( $block );

          else : // FRONT-END

               echo '<div '. get_block_wrapper_attributes( $cparBlockATTR ) .'>';

                    echo '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>';

               echo '</div>';

          endif;

     }

// ASSETS

/*wp_enqueue_block_style(
'cpar/placeholder-text',
CPAR_THEME_URL . CPAR_COMPONENTS . 'blocks/placeholder-text/assets/css/block.css',
array(),
wp_get_theme( CPAR_THEME )->Version,
'all'
);*/


/*
 *   BLOCK REGISTER
 *   https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
*/

     register_block_type( __DIR__ . '/block.json' );