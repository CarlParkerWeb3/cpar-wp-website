<?php

/*
 *   CPAR WEBSITE: ACF Pro (Contact Form)
 *
 *   Author:   Carl A. Parker
 *   Website:  https://CarlParker.dev
*/

if ( ! defined( 'ABSPATH' ) ) : exit; endif; // SILENCE IS GOLDEN


/*
 *   LOADING FORM MARKUP
 *   run acf_form_head() based upon conditional logic
*/

     add_action( 'cpar_html', 'cpar_acf_form_contact_head', 1 );

     function cpar_acf_form_contact_head() {

          //if ( is_page() ) :

               //acf_form_head();

          //endif;

     }


/*
 *   REGISTER
 *   create acf form for website usage
*/

     function cpar_acf_form_contact_register() {

          // PARAMETERS

          $cparScreen = array( 'cpar_screen' => 'contact' );

          // REGISTER

          acf_form( array(

               'id'           => 'Form-Contact',
               'post_id'      => 'new_post',
               'new_post'     => array(

                    'post_type'          => 'cpar_entries',
                    'post_status'        => 'publish',

               ),

               'form'                  => true,
               'form_attributes'       => array( 'class' => 'cpar-form' ),
               'return'                => add_query_arg( $cparScreen, '/confirmation'),
               'fields'                => false,
               'field_groups'          => array( 'group_XXXXXXXXXXXXX' ),
               'html_before_fields'    => '',
               'html_after_fields'     => '<input type="hidden" name="acf[formType]" value="contact" />',
               'label_placement'       => 'top',
               'instruction_placement' => 'field',
               'field_el'              => 'div',
               'honeypot'              => true,
               'submit_value'          => __( 'Send Message', 'cpar-wp-website' ),
               'html_submit_button'    => '<input type="submit" class="acf-button button" value="%s" />',
               'kses'                  => true,

          ) );

     }


/*
 *   POST-FORM SUBMISSION
 *   run specific functionality based upon timing of submission (priority)
*/

     // BEFORE SAVE

     add_action( 'acf/save_post', 'cpar_acf_form_contact_save_before', 5 );

     function cpar_acf_form_contact_save_before( $post_id ) {

          if ( ! is_admin() && $_POST[ 'acf' ][ 'formType' ] == 'contact' ) :

               // ???

          endif;

     }

     // AFTER SAVE

     add_action( 'acf/save_post', 'cpar_acf_form_contact_save_after', 10 );

          function cpar_acf_form_contact_save_after( $post_id ) {

               if ( ! is_admin() && $_POST[ 'acf' ][ 'formType' ] == 'contact' ) :

                    // GENERATE TICKET NUMBER

                    $ticketID = cpar_entries_id( $post_id );

                    // UPDATE META

                    $entryMeta = array(

                         'ID'          =>  $post_id,
                         'post_title'  =>  $ticketID, // create ticket #

                    );

                    wp_update_post( $entryMeta );

                    // UPDATE ACF FIELD - DEFAULT STATUS

                    update_field( 'entries_status', 'open', $post_id );

                    // UPDATE TYPE

                    wp_set_object_terms(

                         $post_id,
                         get_term_by(

                              'slug',
                              'cpar_entries_contact',
                              'cpar_entries_type'

                         )->term_id,
                         'cpar_entries_type'

                    );

               endif;

          }


/*
 *   EMAIL NOTIFICATION
 *   send email after post saved
*/

     add_action( 'acf/save_post', 'cpar_acf_form_contact_notify_email' );

     function cpar_acf_form_contact_notify_email( $post_id ) {

          if ( ! is_admin() && $_POST[ 'acf' ][ 'formType' ] == 'contact' ) :

               $post = get_post( $post_id );

               // GENERATE TICKET NUMBER

               $ticketID = cpar_entries_id( $post_id );

               // GET FIELD DATA

               $name     = $_POST[ 'acf' ][ 'field_XXXXXXXXXXXXX' ];
               $email    = $_POST[ 'acf' ][ 'field_XXXXXXXXXXXXX' ];
               $message  = $_POST[ 'acf' ][ 'field_XXXXXXXXXXXXX' ];
               //$method = implode( ', ', $_POST[ 'acf' ][ 'field_XXXXXXXXXXXXX' ] );

               // EMAIL SETUP

               $headers  = "MIME-Version: 1.0" . "\n";
               $headers .= "Content-type: text/html; charset=iso-8859-1" . "\n";
               $headers .= "X-Priority: 1 (Highest)\n";
               $headers .= "X-MSMail-Priority: High\n";
               $headers .= "Importance: High\n";

               $headers .= "From: " . get_option( 'name' ) ." <website@" . CPAR_DOMAIN . ">" . "\n"; // CHANGE?
               $headers .= "Return-Path: " . get_option( 'name' ) ." <website@" . CPAR_DOMAIN . ">" . "\n"; // CHANGE?
               $headers .= "Reply-To: ' . $name . ' <' . $email . '>";

               $to       = get_option( 'admin_email' ); // CHANGE?
               $subject  = 'Website Contact Form Inquiry (#'. $ticketID .')';

               $body     = '

                    <p>Name: ' . $name . '</p>

                    <p>Email: ' . $email . '</p>

                    <p>Message: ' . $message . '</p>

               ';

               // SEND EMAIL

               wp_mail ( $to, $subject, $body, $headers );

          endif;

     }