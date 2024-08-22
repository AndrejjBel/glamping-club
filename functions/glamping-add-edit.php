<?php
// Add glampings
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
        $error['inputs']['glamping_title'] = __( 'Error post title', 'glamping-club' );
    }
    if ( !$_POST['glamping_location'] ) {
        $error['inputs']['glamping_location'] = __( 'Select location', 'glamping-club' );
    }
    if ( !$_POST['glamping_description'] ) {
        $error['empty_description'] = __( 'Error post description', 'glamping-club' );
    }
    if ( !$_POST['glamping_type'] ) {
        $error['multicheck']['glamping_type'] = __( 'Error glamping type', 'glamping-club' );
    }
    if ( !$_POST['glamping_allocation'] ) {
        $error['multicheck']['glamping_allocation'] = __( 'Error glamping allocation', 'glamping-club' );
    }
    if ( !$_POST['glamping_number_houses'] ) {
        $error['inputs']['glamping_number_houses'] = __( 'Error glamping number houses', 'glamping-club' );
    }
    if ( !$_POST['glamping_price'] ) {
        $error['inputs']['glamping_price'] = __( 'Error glamping price', 'glamping-club' );
    }
    if ( $_POST['working_mode'] == 'seasonal' ) {
        if ( !$_POST['working_mode_seasons'] ) {
            $error['multicheck']['working_mode_seasons'] = __( 'Error working mode seasons', 'glamping-club' );
        }
    }

    if ( !$_POST['additionally_field'][0]['address'] ) {
        $error['additionally_field']['additionally_field_0_address'] = __( 'Error glamping address', 'glamping-club' );
    }
    if ( !$_POST['additionally_field'][0]['coordinates'] ) {
        $error['additionally_field']['additionally_field_0_coordinates'] = __( 'Error glamping coordinates', 'glamping-club' );
    }
    if ( !$_POST['additionally_field'][0]['checkin_glamping'] ) {
        $error['additionally_field']['additionally_field_0_checkin_glamping'] = __( 'Error glamping checkin', 'glamping-club' );
    }
    if ( !$_POST['additionally_field'][0]['checkout_glamping'] ) {
        $error['additionally_field']['additionally_field_0_checkout_glamping'] = __( 'Error glamping checkout', 'glamping-club' );
    }

    if ($_POST['action_type'] == 'edit') {
        $post = get_post( $_POST['object_id'] );
        if ( $post->post_author != $_POST['user_id']) {
            $error['empty_post_author'] = __( 'Error post author', 'glamping-club' );
        }
    }

    if ( !$_POST['additionally_field'][0]['site_glamping'] ) {
        $error['additionally_field']['additionally_field_0_site_glamping'] = __( 'Error glamping price', 'glamping-club' );
    } else {
        $url = $_POST['additionally_field'][0]['site_glamping'];
        if ($url) {
            if (filter_var($url, FILTER_VALIDATE_URL) === false) {
                $error['additionally_field']['empty_site_glamping_valid'] = __( 'Error post site valid', 'glamping-club' );
            }
        }
    }

    $acc_req_field_false = [];
    if (count($_POST['acc_options']) == 1) {
        $meta_object_nn = $_POST['acc_options'][0];
        foreach ($meta_object_nn as $key => $value) {
            if (empty($value)) { //проверка на пустоту
                unset($meta_object_nn[$key]); // Удаляем ключ массива
            }
        }
        if ($meta_object_nn) {
            $acc_req_field = array(
                'title',
                'description',
                'area',
                'places',
                'price'
            );
            $error['acc_req_field_def'] = $acc_req_field;
            $acc_req_field_n = '';
            $key_n = [];
            foreach ($meta_object_nn as $key => $value) {
                $key_n[] =  $key;
            }
            $acc_req_field_false = array_diff($acc_req_field, $key_n);

            // $error['meta_object_nn'] = $meta_object_nn;
            if ($acc_req_field_false) {
                $error['false_acc_options'] = array_values($acc_req_field_false);
            }
        }
    } elseif (count($_POST['acc_options']) > 1) {
        $acc_options_arr = [];
        $acc_req_field_false = [];
        foreach ($_POST['acc_options'] as $key => $options_item) {
            $acc_options_arr[] = $options_item;

            foreach ($options_item as $key => $value) {
                if (empty($value)) { //проверка на пустоту
                    unset($options_item[$key]); // Удаляем ключ массива
                }
            }
            if ($options_item) {
                $acc_req_field = array(
                    'title',
                    'description',
                    'area',
                    'places',
                    'price'
                );
                // $error['acc_req_field_def'] = $acc_req_field;
                // $acc_req_field_n = '';
                $key_n = [];
                foreach ($options_item as $key => $value) {
                    $key_n[] =  $key;
                }
                $acc_req_field_false_it = array_diff($acc_req_field, $key_n);
            }
            $acc_req_field_false[] = array_values($acc_req_field_false_it);

            // $error['meta_object_nn'] = $meta_object_nn;
            if ($acc_req_field_false) {
                foreach ($acc_req_field_false as $key => $value) {
                    if (!$value) {
                        unset($acc_req_field_false[$key]);
                    }
                }
            }
            if ($acc_req_field_false) {
                $error['false_acc_options'] = array_values($acc_req_field_false);
            }
        }
    }

    if ( count( $error ) > 0 ) {

        $error['type'] = 'errors';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    } else {
        if ($_POST['action_type'] == 'add') {
            $post_data = array(
                'post_author'   => $_POST['user_id'],
                'post_status'   => 'draft',
                'post_type'     => 'glampings',
                'post_title'    => sanitize_text_field( $_POST['glamping_title'] ),
    	        'post_content'  => $_POST['glamping_description']
            );
            $post_id = wp_insert_post( $post_data );
            update_post_meta( $post_id, 'glamping_recommended', 'no' );
            $text = 'Опубликован новый глэмпинг';
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
            $text = 'Изменен глэмпинг';
        }

        if ($post_id) {
            wp_set_object_terms( $post_id, (int)$_POST['glamping_location'], 'location' );

            $keys = [
                'nonce',
                'nonce_CMB2phpsingle_glampings_front',
                'nonce_CMB2phpmedia_gallery_front',
                'nonce_CMB2phpaccommodation_options_front',
                'action',
                'action_type',
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
            $post_title = get_the_title($post_id);

            $text_fin = $text . ' - ' . $post_title . ' - ' . wp_unslash($post_url);
            message_to_telegram($text_fin, '477875115');
            message_to_telegram($text_fin, '504444402');

            $error['type'] = 'success';
            $error['post_id'] = $post_id;
            $error['post_url'] = wp_unslash($post_url);
            $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
            echo $error_fin;
            wp_die();
        } else {
            $error['type'] = 'error';
            $error['post_id'] = $post_id;
            $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
            echo $error_fin;
            wp_die();
        }
    }
    wp_die();
}
