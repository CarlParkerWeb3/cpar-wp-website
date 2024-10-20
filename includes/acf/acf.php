<?php

/*
 *   CPAR WEBSITE: Includes (ACF Pro)
 *
 *   Author:   Carl A. Parker
 *   Website:  https://CarlParker.dev
*/

if ( ! defined( 'ABSPATH' ) ) : exit; endif; // SILENCE IS GOLDEN


/*
 *   PLUGIN VERIFICATION
 *   display admin notice when ACF Pro is not active
*/

     // SITE KEY

     define( 'ACF_PRO_LICENSE', '###' ); // set acf license key here

     // ADMIN NOTICE

     add_action( 'admin_notices', 'cpar_acf_plugin_inactive' );

     function cpar_acf_plugin_inactive() {

          if ( ! class_exists( 'ACF' ) ) :

               echo '<div class="notice notice-error cpar-notice">';

                    echo '<p>' . __( '<code>ADVANCED CUSTOM FIELDS PRO</code>plugin is not active. Your website requires this to function properly.', 'cpar-wp-website' ) . '</p>';

               echo '</div>';

          endif;

     }


/*
 *   LOCAL JSON
 *   https://www.advancedcustomfields.com/resources/local-json/
*/

     // SAVE JSON FILES

     add_filter( 'acf/settings/save_json', 'cpar_acf_localjson_save' );

     function cpar_acf_localjson_save( $path ) {

          $path = CPAR_THEME_PATH . CPAR_INCLUDES . 'acf/json/';

          return $path;

     }

     // LOAD JSON FILES

     add_filter( 'acf/settings/load_json', 'cpar_acf_localjson_load' );

     function cpar_acf_localjson_load( $paths ) {

          unset( $paths[ 0 ] );

          $paths[] = CPAR_THEME_PATH . CPAR_INCLUDES . 'acf/json/';

          return $paths;

     }


/*
 *   DASHBOARD INTERFACE
 *   enhance the wp dashboard
*/

     if ( get_current_user_id() != 1 ) :

          // HIDE ADMIN MENU FOR NON-CPAR USER

          add_filter( 'acf/settings/show_admin', '__return_false');

          // HIDE ACF UPDATES SUBMENU

          add_filter( 'acf/settings/show_updates', '__return_false', 100 );

     endif;

     // ADMIN OPTIONS MENU

     add_action( 'acf/init', 'cpar_acf_options_settings' );

     function cpar_acf_options_settings() {

          $website = acf_add_options_page( array(

               'page_title'      => __( 'Custom Website Configurations', 'cpar-wp-website' ),
               'menu_title'      => __( 'CPar Website', 'cpar-wp-website' ),
               'menu_slug'       => 'cpar-wp-website',
               'capability'      => 'edit_theme_options',
               'position'        => 2,
               'icon_url'        => 'dashicons-wordpress',
               'redirect'        => false,
               'autoload'        => true,
               'update_button'   => __( 'Update Settings', 'cpar-wp-website' ),
               'updated_message' => __( 'Your custom website settings have been updated', 'cpar-wp-website' ),

          ) );

     }


/*
 *   WP QUERIES
 *   include acf fields/values to be included in queries
*/

     // POSTS_JOIN -- https://developer.wordpress.org/reference/hooks/posts_join/

     add_filter( 'posts_join', 'cpar_acf_queries_join' );

     function cpar_acf_queries_join( $join ) {

          global $wpdb;

          if ( is_search() ) :

               $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';

          endif;

          return $join;

     }

     // POSTS_WHERE -- https://developer.wordpress.org/reference/hooks/posts_where/

     add_filter( 'posts_where', 'cpar_acf_queries_where' );

     function cpar_acf_queries_where( $where ) {

          global $pagenow, $wpdb;

          if ( is_search() ) :

               $where = preg_replace(

                    "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
                    "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where

               );

          endif;

          return $where;

     }

     // POSTS_DISTINCT -- https://developer.wordpress.org/reference/hooks/posts_distinct/

     add_filter( 'posts_distinct', 'cpar_acf_queries_distinct' );

     function cpar_acf_queries_distinct( $where ) {

          global $wpdb;

          if ( is_search() ) :

               return "DISTINCT";

          endif;

          return $where;

     }


/*
 *   ACF BLOCK PREVIEW
 *   generate standard block preview in Gutenberg Editor
*/

     // PREPARE SETTINGS

     function cpar_acf_blocks_setup( $block, $post_id, $is_preview ) {

          // ANCHOR ID

          if ( ! empty( $block[ 'anchor' ] ) ) :

               $block_id = esc_attr( $block[ 'anchor' ] );

          else :

               $block_id = '';

          endif;

          // DEFINE ATTRIBUTES

          $blockATTR = array(

               'data-cpar-block' => $block[ 'name' ],
               'id'              => $block_id,
               'class'           => ''

          );

          return $blockATTR;

     }

     // RENDER PREVIEW

     function cpar_acf_blocks_preview( $block, $innerblock = false ) {

          echo '<div class="cpar-block-preview">';

               echo '<span class="cpar-block-preview-name">'. $block[ 'name' ] .'</span>';

               if ( $innerblock == true ) :

                    echo '<span class="cpar-block-preview-inner">';

                         echo '<InnerBlocks />';

                    echo '</span>';

               endif;

          echo '</div>';

     }


/*
 *   FRONT-END FORMS
 *   include acf front-end forms
*/

     // REGISTER ENTRY RECORDS

     require_once 'acf-entries.php';

     // LOAD FORMS

     add_action( 'init', 'cpar_acf_forms' );

     function cpar_acf_forms() {

          foreach ( glob( CPAR_THEME_PATH . CPAR_INCLUDES . 'acf/forms/form-*.php' ) as $form ) :

               require_once $form;

          endforeach;

     }


/*
 *   THEME BLOCKS
 *   include gutenberg blocks
*/

     add_action( 'after_setup_theme', 'cpar_theme_blocks', 13 );

     function cpar_theme_blocks() {

          foreach ( glob( CPAR_THEME_PATH . CPAR_INCLUDES . 'acf/blocks/*/block.php' ) as $block ) :

               require_once $block;

          endforeach;

     }