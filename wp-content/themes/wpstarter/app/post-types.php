<?php

if (!function_exists('create_post_type')) :

    function create_post_type()
    {
//        register_post_type(
//            'faqs',
//            array(
//                'labels' => array(
//                    'name' => __('FAQ'),
//                    'singular_name' => __('FAQ'),
//                    'add_new' => __('Add'),
//                ),
//                'show_in_rest' => true,
//                'public' => true,
//                'publicly_queryable' => false,
//                'has_archive' => false,
//                'supports' => array('title', 'custom_fields', 'revisions'),
//                'menu_icon' => 'dashicons-editor-textcolor',
//                'rewrite' => false //array( 'slug' => 'faqs', 'with_front' => false ),
//            )
//        );
//
//        register_post_type(
//            'jobs',
//            array(
//                'labels' => array(
//                    'name' => __('Jobs'),
//                    'singular_name' => __('Job'),
//                    'add_new' => __('Add'),
//                ),
//                'show_in_rest' => true,
//                'public' => true,
//                'publicly_queryable' => true,
//                'has_archive' => false,
//                'supports' => array('title', 'custom_fields', 'revisions', 'page-attributes', 'thumbnail'),
//                'menu_icon' => 'dashicons-nametag',
//                'rewrite' => array('slug' => 'careers', 'with_front' => false),
//            )
//        );

    }

    add_action('init', 'create_post_type');

endif; // ####
