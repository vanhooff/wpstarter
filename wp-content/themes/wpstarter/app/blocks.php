<?php

/**
 * Check if ACF is installed and active
 */
function is_acf_active(): bool {
    return class_exists( 'ACF' );
}

/**
 * Add admin notice if ACF is not installed
 */
function acf_missing_notice(): void {
    $class   = 'notice notice-error';
    $message = sprintf(
        __( 'Warning: Advanced Custom Fields PRO (ACF) is required for this theme to function properly. %sPlease install and activate ACF%s.', 'sage' ),
        '<a href="https://www.advancedcustomfields.com/pro/">',
        '</a>'
    );

    printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message );
}

add_action( 'init', 'register_acf_blocks' );

/**
 * Auto discover and register ACF blocks.
 */
function register_acf_blocks(): void {
    // Check if ACF is active
    if ( ! is_acf_active() ) {
        add_action( 'admin_notices', 'acf_missing_notice' );

        return;
    }

    $blocks_dir = get_template_directory() . '/resources/views/blocks/';

    foreach ( glob( $blocks_dir . '*', GLOB_ONLYDIR ) as $block_dir ) {
        $block_name = basename( $block_dir );

        // Define the path to the SVG file within the block's directory.
        $svg_path = $block_dir . '/' . $block_name . '.svg';

        // Check if the SVG file exists and convert the path to a URL.
        $svg_url = file_exists( $svg_path ) ? file_get_contents( $svg_path ) : '';

        $block_settings = array(
            'name'            => $block_name,
            'title'           => ucwords( str_replace( '-', ' ', $block_name ) ),
            'mode'            => 'edit',
            'render_callback' => 'render_acf_block',
            'icon'            => $svg_url,
        );

        acf_register_block_type( $block_settings );
    }
}

/**
 * Callback function to render the ACF block with Blade template
 */
function render_acf_block( $block, $content = '', $is_preview = false, $post_id = 0 ): void {
    if ( ! is_acf_active() ) {
        echo 'ACF is required for this block to function properly.';

        return;
    }

    // Convert the block name into the expected Blade view format.
    $slug = str_replace( 'acf/', '', $block['name'] );
    $view = "blocks.{$slug}.{$slug}";

    // Ensure Acorn is bootstrapped and ready using the new method
    if ( class_exists( '\Roots\Acorn\Application' ) ) {
        \Roots\Acorn\Application::configure()->boot();
    }

    // Use the view() helper function provided by Acorn to render the Blade template.
    echo view( $view, compact( 'block', 'content', 'is_preview', 'post_id' ) )->render();
}

/**
 * Filter allowed block types
 */
function allowed_block_types( $allowed_blocks, $editor_context ): array {
    if ( ! is_acf_active() ) {
        return [];
    }

    $registered_blocks = WP_Block_Type_Registry::get_instance()->get_all_registered();

    // Filter the registered blocks to only include blocks from the specified namespace.
    $allowed_blocks = array_filter(
        array_keys( $registered_blocks ),
        function ( $block_name ) {
            return str_starts_with( $block_name, 'acf/' );
        }
    );

    $allowed_extra = array(
        // Allow extra blocks here
        // 'core/paragraph',
        // 'core/image',
    );

    $allowed_blocks = array_merge( $allowed_blocks, $allowed_extra );

    return array_values( $allowed_blocks );
}

add_filter( 'allowed_block_types_all', 'allowed_block_types', 25, 2 );

// Set local JSON save path for version control of ACF
function local_acf_fields( $path ): string {
    return get_stylesheet_directory() . '/resources/fields';
}

add_filter( 'acf/settings/save_json', 'local_acf_fields' );

// Set local JSON loads path for version control of ACF
function fields_load_point( $paths ) {
    unset( $paths[0] );
    $paths[] = get_stylesheet_directory() . '/resources/fields';

    return $paths;
}

add_filter( 'acf/settings/load_json', 'fields_load_point' );
