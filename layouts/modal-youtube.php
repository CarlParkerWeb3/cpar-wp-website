<?php

/*
 *   CPAR WEBSITE: Layouts (YouTube Modal)
 *
 *   Author:   Carl A. Parker
 *   Website:  https://CarlParker.dev
*/

if ( ! defined( 'ABSPATH' ) ) : exit; endif; // SILENCE IS GOLDEN ?>


<aside data-cpar-element="modal-youtube" style="display:none">

     <div class="cpar-modal-background"></div>

     <div class="cpar-modal-box">

          <div class="cpar-modal-close">

               <i class="fa-regular fa-rectangle-xmark"></i>

          </div>

          <span class="cpar-modal-heading">

               <?php _e( 'Play Video', 'cpar-wp-website' ); ?>

          </span>

          <div class="cpar-modal-content">

               <div class="cpar-modal-video">

                    <iframe class="cpar-video-iframe" id="video" width="640" height="385" src="#" frameborder="0"></iframe>

               </div>

          </div>

     </div>

</aside>