<?php

/*
 *   CPAR WEBSITE: Includes (ACF Pro - Form Entries)
 *
 *   Author:   Carl A. Parker
 *   Website:  https://CarlParker.dev
*/

if ( ! defined( 'ABSPATH' ) ) : exit; endif; // SILENCE IS GOLDEN


/*
 *   SCREENS
 *   custom query var for screen conditionals
*/

     add_filter( 'query_vars', 'cpar_entries_queryvar_screen' );

     function cpar_entries_queryvar_screen( $vars ) {

        $vars[] .= 'cpar_screen';

          return $vars;

     }


/*
 *   REGISTER
 *   create custom post type + taxonomy
*/

     add_action( 'init', 'cpar_entries_register' );

     function cpar_entries_register() {

          // CUSTOM POST TYPE

          $labels = array(

               'menu_name'                   => __( 'Form Entries', 'cpar-wp-website' ),
               'name'                        => __( 'Web Form Entries', 'cpar-wp-website' ),
               'singular_name'               => __( 'Entry', 'cpar-wp-website' ),
               'add_new'                     => __( 'Add New Entry', 'cpar-wp-website' ),
               'add_new_item'                => __( 'Add New Entry', 'cpar-wp-website' ),
               'edit_item'                   => __( 'Edit Entry', 'cpar-wp-website' ),
               'new_item'                    => __( 'New Entry', 'cpar-wp-website' ),
               'view_item'                   => __( 'View Entry', 'cpar-wp-website' ),
               'view_items'                  => __( 'View Entries', 'cpar-wp-website' ),
               'search_items'                => __( 'Search Entries', 'cpar-wp-website' ),
               'not_found'                   => __( 'No entries found', 'cpar-wp-website' ),
               'not_found_in_trash'          => __( 'No entries found in Trash', 'cpar-wp-website' ),
               'parent_item_colon'           => __( 'Parent Entry:', 'cpar-wp-website' ),
               'all_items'                   => __( 'All Entries', 'cpar-wp-website' ),
               'archives'                    => __( 'Entry Archives', 'cpar-wp-website' ),
               'attributes'                  => __( 'Entry Attributes', 'cpar-wp-website' ),
               'insert_into_item'            => __( 'Insert into entry', 'cpar-wp-website' ),
               'uploaded_to_this_item'       => __( 'Uploaded to this entry', 'cpar-wp-website' ),
               'featured_image'              => __( 'Featured Image', 'cpar-wp-website' ),
               'set_featured_image'          => __( 'Set Featured Image', 'cpar-wp-website' ),
               'remove_featured_image'       => __( 'Remove Featured Image', 'cpar-wp-website' ),
               'use_featured_image'          => __( 'Use as Featured Image', 'cpar-wp-website' ),
               'filter_items_list'           => __( 'Filter Entries list', 'cpar-wp-website' ),
               'filter_by_date'              => __( 'Filter by Date', 'cpar-wp-website' ),
               'items_list_navigation'       => __( 'Entries list navigation', 'cpar-wp-website' ),
               'items_list'                  => __( 'Entries list', 'cpar-wp-website' ),
               'item_published'              => __( 'Entry published', 'cpar-wp-website' ),
               'item_published_privately'    => __( 'Entry published privately', 'cpar-wp-website' ),
               'item_reverted_to_draft'      => __( 'Entry reverted to draft', 'cpar-wp-website' ),
               'item_scheduled'              => __( 'Entry scheduled', 'cpar-wp-website' ),
               'item_updated'                => __( 'Entry updated', 'cpar-wp-website' ),
               'item_link'                   => __( 'Entry Link', 'cpar-wp-website' ),
               'item_link_description'       => __( 'A link to an entry', 'cpar-wp-website' ),

          );

          $args = array(

               'labels'                 => $labels,
               'description'            => 'collection of web form entries',
               'public'                 => false,
               'hierarchical'           => false,
               'exclude_from_search'    => true,
               'publicly_queryable'     => false,
               'show_ui'                => true,
               'show_in_menu'           => true,
               'show_in_nav_menus'      => false,
               'show_in_admin_bar'      => false,
               'show_in_rest'           => true,
               'menu_position'          => 40,
               'menu_icon'              => 'dashicons-feedback',
               'capabilities'           => array(

                    'edit_post'              => 'edit_theme_options',
                    'read_post'              => 'edit_theme_options',
                    'delete_post'            => 'edit_theme_options',
                    'edit_posts'             => 'edit_theme_options',
                    'edit_others_posts'      => 'edit_theme_options',
                    'delete_posts'           => 'edit_theme_options',
                    'publish_posts'          => 'edit_theme_options',
                    'read_private_posts'     => 'edit_theme_options'

               ),

               'supports'               => array( 'title' ),
               'taxonomies'             => array( 'cpar_entries_type' ),
               'has_archive'            => false,
               'rewrite'                => array( 'slug' => 'cpar_entries' ),
               'query_var'              => false,
               'can_export'             => true,
               'delete_with_user'       => false,
               'template'               => array(),
               'template_lock'          => false,

          );

          register_post_type( 'cpar_entries', $args );

          // CUSTOM TAXONOMIES

          $labels = array(

               'name'                        => __( 'Entry Types', 'cpar-wp-website' ),
               'singular_name'               => __( 'Entry Type', 'cpar-wp-website' ),
               'search_items'                => __( 'Search Entry Types', 'cpar-wp-website' ),
               'popular_items'               => __( 'Popular Entry Types', 'cpar-wp-website' ),
               'all_items'                   => __( 'All Entry Types', 'cpar-wp-website' ),
               'parent_item'                 => __( 'Parent Type', 'cpar-wp-website' ),
               'parent_item_colon'           => __( 'Parent Type:', 'cpar-wp-website' ),
               'edit_item'                   => __( 'Edit Entry Type', 'cpar-wp-website' ),
               'view_item'                   => __( 'View Entry Type', 'cpar-wp-website' ),
               'update_item'                 => __( 'Update Entry Type', 'cpar-wp-website' ),
               'add_new_item'                => __( 'Add New Entry Type', 'cpar-wp-website' ),
               'new_item_name'               => __( 'New Entry Type Name', 'cpar-wp-website' ),
               'separate_items_with_commas'  => __( 'Separate entry types with commas', 'cpar-wp-website' ),
               'add_or_remove_items'         => __( 'Add or remove entry types', 'cpar-wp-website' ),
               'choose_from_most_used'       => __( 'Choose from the most used entry types', 'cpar-wp-website' ),
               'not_found'                   => __( 'No entry types found', 'cpar-wp-website' ),
               'no_terms'                    => __( 'No entry types', 'cpar-wp-website' ),
               'filter_by_item'              => __( 'Filter by entry type', 'cpar-wp-website' ),
               'items_list_navigation'       => __( 'Items list navigation', 'cpar-wp-website' ),
               'items_list'                  => __( 'Items list', 'cpar-wp-website' ),
               'most_used'                   => __( 'Most Used', 'cpar-wp-website' ),
               'back_to_items'               => __( 'Back to Entry Types', 'cpar-wp-website' ),
               'item_link'                   => __( 'Entry Type link', 'cpar-wp-website' ),
               'item_link_description'       => __( 'A link to an entry type', 'cpar-wp-website' ),

          );

          $args = array(

               'labels'                 => $labels,
               'description'            => 'organize web form entries by type',
               'public'                 => false,
               'publicly_queryable'     => false,
               'hierarchical'           => true,
               'show_ui'                => true,
               'show_in_menu'           => true,
               'show_in_nav_menus'      => false,
               'show_in_rest'           => true,
               'show_tagcloud'          => false,
               'show_in_quick_edit'     => false,
               'show_admin_column'      => true,
               'rewrite'                => array( 'slug' => 'cpar_entries_type' ),
               'query_var'              => false,
               'update_count_callback'  => '_update_post_term_count',
               'sort'                   => null,
               'capabilities'           => array(

                    'manage_terms'       => 'edit_theme_options',
                    'edit_terms'         => 'edit_theme_options',
                    'delete_terms'       => 'edit_theme_options',
                    'assign_terms'       => 'edit_theme_options'

               ),

               'default_term'          => array(

                    'name'         => 'Contact Form',
                    'slug'         => 'cpar_entries_contact',
                    'description'  => ''

               )

          );

          register_taxonomy( 'cpar_entries_type', array( 'cpar_entries' ), $args );

     }


/*
 *   ENTRIES ID
 *   convert post id into unique pre-fixed ID
*/

     // GENERATOR

     function cpar_entries_id( $post_id = null ) {

          if ( $post_id ) :

               // PREFIX

               $ticketPrefix = 'CPAR';

               // TICKET FORMAT

               $ticketID = $ticketPrefix . '-0000000';

               // UPDATE WITH POST ID

               $ticketID = substr( $ticketID, 0, strlen( $post_id ) * -1 ) . $post_id;

               // RETURN VALUE

               return $ticketID;

          endif;

     }

     // POST TITLE AS ENTRY ID

     add_action( 'save_post_cpar_entries', 'cpar_entries_title' );

     function cpar_entries_title( $post_id ) {

          if ( is_admin() ) :

               // GENERATE TICKET NUMBER

               $ticketID = cpar_entries_id( $post_id );

               // UN-HOOK TO ELIMINATE INFINITE LOOP

               remove_action( 'save_post_cpar_entries', 'cpar_entries_title' );

               // UPDATE META

               $entryMeta = array(

                    'ID'           => $post_id,
                    'post_title'   => $ticketID

               );

               wp_update_post( $entryMeta, false, false );

               // RE-HOOK

               add_action( 'save_post_cpar_entries', 'cpar_entries_title' );

          endif;

     }

/*
 *   ADMIN EDIT SCREEN COLUMNS
 *   customized for improved experience
*/

     // ADD ENTRY COLUMNS

     add_filter ( 'manage_cpar_entries_posts_columns', 'cpar_entries_admincols_manage' );

     function cpar_entries_admincols_manage( $columns ) {

          return array_merge ( $columns, array (

               'entries_status'		=>	__ ( 'Status' )

          ) );

     }

     // DISPLAY ENTRY COLUMN VALUES

     add_action ( 'manage_cpar_entries_posts_custom_column', 'cpar_entries_admincols_values', 10, 2 );

     function cpar_entries_admincols_values ( $column, $post_id ) {

          switch ( $column ) {

               case 'entries_status' :

                    if ( ! empty( get_field( 'entries_status', $post_id ) ) ) :

                         $appStatus = get_field( 'entries_status' );

                         echo '<span class="entries-status '. $appStatus .'">'. $appStatus . '</span>';

                    endif;

               break;

          }

     }

     // MAKE ENTRY COLUMNS SORTABLE

     add_filter( 'manage_edit-cpar_entries_sortable_columns', 'cpar_entries_admincols_sortable' );

     function cpar_entries_admincols_sortable( $columns ) {

          $columns[ 'entries_status' ] = 'entries_status';

          return $columns;

     }

     // RE-ORDER ENTRIES COLUMNS

     add_filter( 'manage_cpar_entries_posts_columns', 'cpar_entries_admincols_reorder' );

     function cpar_entries_admincols_reorder( $columns ) {

          $columnOrder = array(

               'cb'                => $columns[ 'cb' ],
               'title'             => $columns[ 'title' ],
               'entries_status'    => $columns[ 'entries_status' ]

          );

          return $columnOrder;

     }