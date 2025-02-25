<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter( 'excerpt_more', function () {
    return sprintf( ' &hellip; <a href="%s">%s</a>', get_permalink(), __( 'Continued', 'sage' ) );
} );

// Add a custom shortcode that disables texturization
function my_custom_no_texturize_shortcode( $shortcodes ) {
    $shortcodes[] = 'no_texturize';

    return $shortcodes;
}

add_filter( 'no_texturize_shortcodes', __NAMESPACE__ . '\my_custom_no_texturize_shortcode' );

// Shortcode callback function that just returns the content
function my_no_texturize_shortcode_callback( $atts, $content = '' ) {
    return $content;
}

add_shortcode( 'no_texturize', __NAMESPACE__ . '\my_no_texturize_shortcode_callback' );


// Disable h1 in ACF paragraph
function acf_tinymce_options( $init ) {

    if ( ! function_exists( 'acf' ) ) {
        return $init;
    }

    // Define custom block formats excluding h1
    $custom_formats = 'Paragraph=p;Header 2=h2;Header 3=h3;Header 4=h4;Header 5=h5;Header 6=h6;Preformatted=pre';

    // If block_formats is set, override it. If not, add it.
    $init['block_formats'] = $custom_formats;

    return $init;
}

add_filter( 'tiny_mce_before_init', __NAMESPACE__ . '\acf_tinymce_options' );

// disable comments
add_action( 'admin_init', function () {
    // Disable support for comments and trackbacks in post types
    foreach ( get_post_types() as $post_type ) {
        if ( post_type_supports( $post_type, 'comments' ) ) {
            remove_post_type_support( $post_type, 'comments' );
            remove_post_type_support( $post_type, 'trackbacks' );
        }
    }
} );

// Close comments on the front-end
add_filter( 'comments_open', '__return_false', 20, 2 );
add_filter( 'pings_open', '__return_false', 20, 2 );

// Hide existing comments
add_filter( 'comments_array', '__return_empty_array', 10, 2 );

// Remove comments page in admin menu
add_action( 'admin_menu', function () {
    remove_menu_page( 'edit-comments.php' );
} );

// Disable admin bar comment link
add_action( 'wp_before_admin_bar_render', function () {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'comments' );
} );

