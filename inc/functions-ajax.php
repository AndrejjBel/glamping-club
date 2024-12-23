<?php
add_action('wp_ajax_contact', 'glamping_club_contact');
add_action('wp_ajax_nopriv_contact', 'glamping_club_contact');
function glamping_club_contact () {
    $error = array();

    if ( !wp_verify_nonce( $_POST['nonce'], 'glamping_club' ) ) {
        $error['empty_nonce'] = __('Error, please try again later', 'glamping-club');
    }

    if ( !$_POST['name_contact'] ) {
        $error['name'] = __( 'Заполните поле Имя', 'glamping-club' );
    }

    if ( !$_POST['phone_contact'] ) {
        $error['phone'] = __( 'Заполните поле Телефон', 'glamping-club' );
    }

    if ( !$_POST['privacy'] ) {
        $error['privacy'] = __( 'Необходимо согласие на обработку персональных данных', 'glamping-club' );
    }

    if ( count( $error ) > 0 ) {
        $error['class'] = 'error';
        $error['post'] = $_POST;
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    } else {
        $from_email = get_glc_option('glc_options', 'from_email');

        $mailTo = get_glc_option('glc_options', 'contact_email');

        $site_name = get_bloginfo('name');
        $admin_email = get_bloginfo('admin_email');
        // $mailTo = $_POST['user_email'];
        $subject = 'Заявка на консультацию ' . $site_name;
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "From: " . $from_email . " <" . $from_email . ">\r\n";
        $name = 'Имя: ' . $_POST['name_contact'] . ' ';
        $phone = 'Телефон: ' . $_POST['phone_contact'] . ' ';
        $message = '<p>Заявка на консультацию ' . $site_name . '.</p>';
        $msgotprav = $message ."<br>" . $name . "<br>" . $phone . "<br>";
        // wp_mail($mailTo, $subject, $msgotprav, $headers);

        $text_fin = '<b>Заявка на консультацию</b>' . "\n" . $name . "\n" . 'Телефон: +' . preg_replace("/[^0-9]/", "", $_POST['phone_contact']);
        $glc_options = get_option( 'glc_options' );
        if (array_key_exists('telegram_id', $glc_options)) {
            foreach ($glc_options['telegram_id'] as $telegram_id) {
                message_to_telegram($text_fin, $telegram_id);
            }
        }

        $error['class'] = 'success';
        $error['post'] = $_POST;
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    }
}
