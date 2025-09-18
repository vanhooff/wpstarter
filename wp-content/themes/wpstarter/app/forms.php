<?php
function get_allowed_emails() {
    $allowed_emails = [ // addresses ending with default.nl are whitelisted by default
        'mail@sandervanhooff.com',
    ];

    return array_unique( $allowed_emails );
}

function is_allowed_email( $email ): bool {
    $allowed_emails = get_allowed_emails();

    return in_array( $email, $allowed_emails ) || preg_match( '/@default.nl$/i', $email );
}

function handle_default_form() {
    if ( isset( $_POST['action'] ) && $_POST['action'] === 'default_form' ) {

        define( 'MAX_FILE_SIZE', 3 * 1024 * 1024 );

        $to = isset( $_POST['send_to'] ) ? sanitize_email( $_POST['send_to'] ) : '';

        if ( ! is_allowed_email( $to ) ) {
            $allowed_emails = get_allowed_emails();
            $to             = $allowed_emails[0];
        }

        $subject         = isset( $_POST['subject'] ) ? sanitize_text_field( $_POST['subject'] ) : 'Contact';
        $success_message = isset( $_POST['success_message'] ) ? sanitize_text_field( $_POST['success_message'] ) : 'Bedankt voor uw bericht, we nemen zo spoedig mogelijk contact met u op.';
        $headers         = '';
        $message         = '';
        $attachments     = array();

        foreach ( $_POST as $key => $value ) {
            if ( in_array( $key, array( 'action', 'subject', 'success_message', 'send_to' ) ) ) {
                continue;
            }

            $field_name  = str_replace( '_', ' ', $key );
            $field_name  = ucwords( $field_name );
            $field_value = sanitize_text_field( $value );

            if ( $key === 'email' ) {
                $field_value = sanitize_email( $value );
                $headers     = array(
                    'From: ' . $field_value,
                    'Reply-To: ' . $field_value
                );
                $headers     = implode( "\r\n", $headers ) . "\r\n";
                $subject     .= ' ' . 'van' . ' ' . $field_value;
            }

            $message .= '<strong>' . $field_name . '</strong><br>' . $field_value . "<br><br>";
        }

        if ( isset( $_FILES['attachment'] ) && ! empty( $_FILES['attachment']['name'] ) ) {
            $attachment = $_FILES['attachment'];

            // Check file size
            if ( $attachment['size'] > MAX_FILE_SIZE ) {
                wp_send_json_error( array( 'message' => 'Het bestand is te groot. De maximale bestandsgrootte is 3MB.' ) );
                exit;
            }

            // Check file extension
            $file_extension = strtolower( pathinfo( $attachment['name'], PATHINFO_EXTENSION ) );
            if ( $file_extension !== 'pdf' ) {
                wp_send_json_error( array( 'message' => 'Alleen PDF-bestanden zijn toegestaan.' ) );
                exit;
            }

            // Check MIME type
            $finfo     = finfo_open( FILEINFO_MIME_TYPE );
            $mime_type = finfo_file( $finfo, $attachment['tmp_name'] );
            finfo_close( $finfo );

            if ( $mime_type !== 'application/pdf' ) {
                wp_send_json_error( array( 'message' => 'Het geüploade bestand is geen geldig PDF-bestand.' ) );
                exit;
            }

            $upload_overrides = array( 'test_form' => false );
            $movefile         = wp_handle_upload( $attachment, $upload_overrides );

            if ( $movefile && ! isset( $movefile['error'] ) ) {
                $attachments[] = $movefile['file'];
            } else {
                wp_send_json_error( array( 'message' => 'Er is een fout opgetreden bij het uploaden van het bestand.' ) );
                exit;
            }
        }

        $headers .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";

        if ( wp_mail( $to, $subject, $message, $headers, $attachments ) ) {
            wp_send_json_success( array( 'message' => $success_message ) );
        } else {
            wp_send_json_error( array( 'message' => 'Er is iets misgegaan, probeer het later opnieuw.' ) );
        }
    }
    exit;
}

add_action( 'wp_ajax_nopriv_default_form', 'handle_default_form' );
add_action( 'wp_ajax_default_form', 'handle_default_form' );
