<?php

/*
 *   CPAR WEBSITE: WordPress Header
 *
 *   Author:   Carl A. Parker
 *   Website:  https://CarlParker.dev
*/

if ( ! defined( 'ABSPATH' ) ) : exit; endif; // SILENCE IS GOLDEN ?>


<?php do_action( 'cpar_html' ); ?>

<!DOCTYPE html>

<html <?php language_attributes(); ?> class="no-js no-svg" data-cpar-domain="<?php echo CPAR_DOMAIN; ?>" data-cpar-style="light">

<head>

     <meta charset="<?php bloginfo( 'charset' ); ?>">

     <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

     <?php wp_body_open(); ?>