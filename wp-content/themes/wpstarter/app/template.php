<?php

// General functions used throughout the theme

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

