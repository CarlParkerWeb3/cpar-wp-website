<?php

/*
 *   CPAR WEBSITE: WordPress Functions
 *
 *   Author:   Carl A. Parker
 *   Website:  https://CarlParker.dev
*/

if ( ! defined( 'ABSPATH' ) ) : exit; endif; // SILENCE IS GOLDEN


/*
 *   THEME SETUP
 *   define theme framework for website usage
*/

     define( 'CPAR_DOMAIN', $_SERVER[ 'SERVER_NAME' ] );

     define( 'CPAR_THEME', 'cpar-wp-website' );
     define( 'CPAR_THEME_PATH', trailingslashit( get_template_directory() ) );
     define( 'CPAR_THEME_URL', trailingslashit( get_template_directory_uri() ) );

     define( 'CPAR_ASSETS', trailingslashit( 'assets' ) );
     define( 'CPAR_HELPERS', trailingslashit( 'helpers' ) );
     define( 'CPAR_INCLUDES', trailingslashit( 'includes' ) );
     define( 'CPAR_LAYOUTS', trailingslashit( 'layouts' ) );

     // CONFIGURATIONS

     add_action( 'after_setup_theme', 'cpar_theme_setup', 11 );

     function cpar_theme_setup() {

          // SUPPORTS

          add_post_type_support( 'page', 'excerpt' );

          add_theme_support( 'align-wide' );
          add_theme_support( 'automatic-feed-links' );
          add_theme_support( 'block-template-parts' );
          add_theme_support( 'custom-units', 'rem' );
          add_theme_support( 'editor-styles' );
          add_theme_support( 'html5' , array(

               'search-form',
               'comment-form',
               'comment-list',
               'caption',
               'style',
               'script'

          ) );

          add_theme_support( 'post-thumbnails' );
          add_theme_support( 'responsive-embeds' );
          add_theme_support( 'title-tag' );

          remove_theme_support( 'core-block-patterns' );

          // NAV MENUS

          register_nav_menus( array(

               'cpar-menu-footer-default'    => 'Default Footer',
               'cpar-menu-header-default'    => 'Default Header',
               'cpar-menu-header-upper'      => 'Upper Header',
               'cpar-menu-panel-mobile'      => 'Mobile Panel'

          ) );

          // POST THUMBNAIL

          set_post_thumbnail_size( 1920, 1080 );

     }


/*
 *   THEME HELPERS
 *   include helper functions
*/

     add_action( 'after_setup_theme', 'cpar_theme_helpers', 12 );

     function cpar_theme_helpers() {

          foreach ( glob( CPAR_THEME_PATH . CPAR_HELPERS . '*.php' ) as $helper ) :

               require_once $helper;

          endforeach;

     }


/*
 *   THEME INCLUSIONS
 *   include website functionality
*/

     add_action( 'after_setup_theme', 'cpar_theme_includes', 12 );

     function cpar_theme_includes() {

          // CORE

          require_once CPAR_INCLUDES . 'wordpress/wordpress.php';
          require_once CPAR_INCLUDES . 'acf/acf.php';

          // CUSTOM

          foreach ( glob( CPAR_THEME_PATH . CPAR_INCLUDES . '*/init.php' ) as $feature ) :

               require_once $feature;

          endforeach;

     }


/*
 *   THEME ASSETS
 *   load stylesheets and scripts
*/

     // STYLES + SCRIPTS

     add_action( 'wp_enqueue_scripts', 'cpar_theme_assets_front', 999999999 );

     function cpar_theme_assets_front() {

          // GLOBAL STYLES

          wp_enqueue_style(

               'CPar Website (Front)',
               CPAR_THEME_URL . CPAR_ASSETS . 'css/front.css',
               array(),
               wp_get_theme( CPAR_THEME )->Version,
               'all'

          );

          // GLOBAL SCRIPTS

          wp_enqueue_script(

               'CPar Website (Front)',
               CPAR_THEME_URL . CPAR_ASSETS . 'js/front.js',
               array( 'jquery' ),
               wp_get_theme( CPAR_THEME )->Version,
               true

          );

     }

     // FAVICON

     add_action( 'wp_head', 'cpar_theme_assets_favicon' );

     function cpar_theme_assets_favicon() {

          $favIcon = CPAR_THEME_URL . CPAR_ASSETS . 'images/cpar-icon.png';

               echo '<link rel="icon" href="'. $favIcon .'" sizes="180x180" />';
               echo '<link rel="apple-touch-icon" href="'. $favIcon .'">';

          }


/*
 *   THEME REDIRECTS
 *   redirect conditionally to different template
*/

     // REDIRECTS

     add_action( 'template_redirect', 'cpar_theme_redirects', 999999999 );

     function cpar_theme_redirects() {

          if ( ! is_admin() && is_404() ) : // TO HOMEPAGE UNTIL 404 TEMPLATE

               wp_safe_redirect( home_url(), 301 ); exit;

          endif;

     }