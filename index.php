<?php

/*
 *   CPAR WEBSITE: Main Index Template
 *
 *   Author:   Carl A. Parker
 *   Website:  https://CarlParker.dev
*/

if ( ! defined( 'ABSPATH' ) ) : exit; endif; // SILENCE IS GOLDEN ?>


<?php get_header(); ?>

<!-- CPAR LAYOUT -->

<div data-cpar-layout="full">

     <?php get_template_part( CPAR_LAYOUTS . 'header' ); ?>

     <main data-cpar-region="main">

          <?php the_content(); ?>

     </main>

     <?php get_template_part( CPAR_LAYOUTS . 'footer' ); ?>

</div>

<!-- CPAR ASIDES -->

<?php get_template_part( CPAR_LAYOUTS . 'panel', 'mobile' ); ?>

<?php get_footer(); ?>