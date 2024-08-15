<?php
// Add stories
add_action('wp_ajax_add_post_glampings', 'glamping_club_add_post_glampings');
add_action('wp_ajax_nopriv_add_post_glampings', 'glamping_club_add_post_glampings');
function glamping_club_add_post_glampings() {
    $error = array();
    if ( !wp_verify_nonce( $_POST['nonce'], 'glamping_club' ) ) {
        $error['empty_nonce'] = __( 'Error nonce', 'glamping-club' );
    }

    if ( !$_POST['user_id'] ) {
        $error['empty_user_id'] = __( 'Error user', 'glamping-club' );
    }
    if ( !$_POST['glamping_title'] ) {
        $error['empty_glamping_title'] = __( 'Error post title', 'glamping-club' );
    }
    if ( !$_POST['glamping_location'] ) {
        $error['empty_location'] = __( 'Select location', 'glamping-club' );
    }
    if ($_POST['action_type'] == 'edit') {
        $post = get_post( $_POST['object_id'] );
        if ( $post->post_author != $_POST['user_id']) {
            $error['empty_post_author'] = __( 'Error post author', 'glamping-club' );
        }
    }
    if ( count( $error ) > 0 ) {
        $error['class'] = 'errors';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    } else {
        if ($_POST['action_type'] == 'add') {
            $post_data = array(
                'post_author'   => $_POST['user_id'],
                'post_status'   => 'pending',
                'post_type'     => 'glampings',
                'post_title'    => sanitize_text_field( $_POST['glamping_title'] ),
    	        'post_content'  => $_POST['glamping_description']
            );
            $post_id = wp_insert_post( $post_data );
            $text = 'Опубликован глэмпинг.';
        } elseif ($_POST['action_type'] == 'edit') {
            $update_post = [
                'ID' => $_POST['object_id'],
                'post_status'   => 'pending',
                'post_type'     => 'glampings',
                'post_title'    => sanitize_text_field( $_POST['glamping_title'] ),
    	        'post_content'  => $_POST['glamping_description']
            ];
            wp_update_post( wp_slash( $update_post ) );
            $post_id = $_POST['object_id'];
            $text = 'Изменен глэмпинг.';
        }

        if ($post_id) {
            wp_set_object_terms( $post_id, (int)$_POST['glamping_location'], 'location' );

            $keys = [
                'nonce',
                'nonce_CMB2phpsingle_glampings_front',
                'nonce_CMB2phpmedia_gallery_front',
                'nonce_CMB2phpaccommodation_options_front',
                'action',
                'object_id',
                'user_id',
                'glamping_title',
                'glamping_location',
                'glamping_description',
                'glamping_thumbnail',
                'glamping_thumbnail_id'
            ];

            if ($_POST['glamping_thumbnail_id']) {
                set_post_thumbnail( $post_id, $_POST['glamping_thumbnail_id'] );
                $update_thumbnail = [
                    'ID' => $_POST['glamping_thumbnail_id'],
                    'post_parent' => $post_id,
                ];
                wp_update_post( wp_slash( $update_thumbnail ) );
            }

            foreach ($_POST as $key => $value) {
                if (!in_array($key, $keys)) {
                    update_post_meta( $post_id, $key, $value );
                }
            }

            $all_img = glamping_all_img($post_id);
            foreach ($all_img as $img_id) {
                $update_img = [
                    'ID' => $img_id,
                    'post_parent' => $post_id,
                ];
                wp_update_post( wp_slash( $update_img ) );
            }

            $post_url = get_permalink($post_id);

            $error['success'] = 'Success';
            $error['post_id'] = $post_id;
            $error['post_url'] = wp_unslash($post_url);
            $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
            echo $error_fin;
            wp_die();
        } else {
            $text_fin = $text . ' - ' . $error['post_url'];
            message_to_telegram($text_fin, '477875115');

            $error['error'] = 'Error';
            $error['post_id'] = $post_id;
            $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
            echo $error_fin;
            wp_die();
        }

        // $error['success'] = 'Success';
        // $error['glamping_type'] = $_POST['glamping_type'];
        // $error['acc_options'] = $_POST['acc_options'];
        // $error['post'] = $_POST;
        // $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        // echo $error_fin;

        // wp_die();
    }
    wp_die();
}
