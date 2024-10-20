<?php

/*
 *   CPAR WEBSITE: Layouts (Default Footer)
 *
 *   Author:     Carl A. Parker
 *   Website:    https://CarlParker.dev
*/

if ( ! defined( 'ABSPATH' ) ) : exit; endif; // SILENCE IS GOLDEN ?>


<footer data-cpar-region="footer">

     <div class="footer-copyright">

          <?php echo '&copy; '. date( 'Y' ) .' ' . get_bloginfo( 'name' ); ?>

     </div>

     <div class="footer-credits">

          <?php

               $cparWebsite = 'https://carlparker.dev/?utm_source=webmaster&utm_medium=website&utm_campaign=credits&utm_term='. CPAR_DOMAIN;

               echo '<a href="'. $cparWebsite .'" target="_blank">';

                    echo __( 'a Carl Parker website', 'cpar-wp-website' );

               echo '</a>';
          ?>

     </div>

</footer>