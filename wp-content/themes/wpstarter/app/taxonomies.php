<?php

/**
 * Create taxonomies for custom post types.
 *
 * @see register_post_type() for registering custom post types.
 */
if ( ! function_exists( 'create_taxonomy' ) ) :

    function create_taxonomy() {
        // Add new taxonomy, make it hierarchical (like categories)
//        $labels = array(
//            'name'              => _x( 'Categorieën', 'taxonomy general name', 'sage' ),
//            'singular_name'     => _x( 'Categorie', 'taxonomy singular name', 'sage' ),
//            'search_items'      => __( 'Zoek categorieën', 'sage' ),
//            'all_items'         => __( 'Alle categorieën', 'sage' ),
//            'parent_item'       => __( 'Parent Categorie', 'sage' ),
//            'parent_item_colon' => __( 'Parent Categorie:', 'sage' ),
//            'edit_item'         => __( 'Bewerk Categorie', 'sage' ),
//            'update_item'       => __( 'Update Categorie', 'sage' ),
//            'add_new_item'      => __( 'Categorie toevoegen', 'sage' ),
//            'new_item_name'     => __( 'Categorie naam', 'sage' ),
//            'menu_name'         => __( 'Categorie', 'sage' ),
//        );
//
//        $args = array(
//            'hierarchical'      => true,
//            'labels'            => $labels,
//            'show_ui'           => true,
//            'show_admin_column' => true,
//            'query_var'         => true,
//            'show_in_rest'      => true,
//            'sort'              => true,
//            //'rewrite'           => array('slug' => 'genre'),
//        );
//
//        register_taxonomy( 'faqs_category', array( 'faqs' ), $args );
//
//        unset( $args );
//        unset( $labels );
    }

    add_action( 'init', 'create_taxonomy' );

endif;
