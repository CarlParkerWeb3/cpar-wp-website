<?php

/*
 *   CPAR WEBSITE: Layouts (Mobile Panel)
 *
 *   Author:     Carl A. Parker
 *   Website:    https://CarlParker.dev
*/

if ( ! defined( 'ABSPATH' ) ) : exit; endif; // SILENCE IS GOLDEN ?>


<aside data-cpar-region="panel-mobile">

     <div class="cpar-panel-container">

          <div class="cpar-panel-close">

               <i class="fa-regular fa-rectangle-xmark"></i>

          </div>

          <div class="cpar-panel-body">

               <?php

                    wp_nav_menu( array(

                         'menu'                  => 'Mobile Panel',
                         'menu_id'               => '',
                         'menu_class'            => 'mobile-menu',
                         'container'             => 'ul',
                         'container_id'          => '',
                         'container_aria_label'  => ''

                    ) );

               ?>

          </div>

     </div>

</aside>