<?php

// General functions used throughout the theme

function get_nav_menu_items_simple( $nav_menu_name = 'primary' ): array {
    $menu_items = wp_get_nav_menu_items( $nav_menu_name );
    $menu_name  = get_menu_pretty_name( $nav_menu_name );

    if ( empty( $menu_items ) ) {
        return [];
    }

    // Get current URL
    $current_url = rtrim( get_permalink(), '/' );

    $items = array_map( function ( $item ) use ( $current_url ) {
        $item_url = rtrim( $item->url, '/' );

        return [
            'label'      => $item->title,
            'url'        => $item->url,
            'is_current' => $current_url === $item_url
        ];
    }, $menu_items );

    return [
        'menu_name' => $menu_name,
        'items'     => $items
    ];
}

function get_menu_pretty_name( $menu_name_or_id ) {
    // Try to get menu object directly by name, slug, or ID
    $menu_obj = wp_get_nav_menu_object( $menu_name_or_id );

    if ( ! $menu_obj ) {
        // If that fails, try as a location
        $locations = get_nav_menu_locations();

        if ( isset( $locations[ $menu_name_or_id ] ) ) {
            $menu_obj = wp_get_nav_menu_object( $locations[ $menu_name_or_id ] );
        }
    }

    if ( ! $menu_obj ) {
        return '';
    }

    return $menu_obj->name;
}

function format_phone_number( $phone_number ): string {
    // Remove all non-digit characters
    $phone_number = preg_replace( '/[^0-9]/', '', $phone_number );

    // Check if the number starts with '31' (country code for Netherlands)
    if ( substr( $phone_number, 0, 2 ) === '31' ) {
        $phone_number = substr( $phone_number, 2 );
    }

    // Add the country code and format
    $formatted = '+31(0) ';

    // Format the rest of the number
    $formatted .= substr( $phone_number, 0, 2 ) . ' ';
    $formatted .= substr( $phone_number, 2, 3 ) . ' ';
    $formatted .= substr( $phone_number, 5 );

    return $formatted;
}

