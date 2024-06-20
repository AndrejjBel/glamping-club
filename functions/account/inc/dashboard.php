<?php
// Edit settings
add_action('wp_ajax_edit_settings', 'tripinglamp_edit_settings');
add_action('wp_ajax_nopriv_edit_settings', 'tripinglamp_edit_settings');
function tripinglamp_edit_settings () {
    $error = array();

    $cur_user = hex2bin($_POST['user_id']);
    $user_id = explode("-", $cur_user)[1];

    if ( !wp_verify_nonce( $_POST['nonce'], 'tripinglamp-nonce' ) ) {
        $error['empty_nonce'] = __('Error, please try again later', 'tripinglamp');
    }

    if ( !$user_id ) {
        $error['user_id'] = __('Error, please try again later', 'tripinglamp');
    }

    if ( count( $error ) > 0 ) {
        // $error['class'] = 'errors';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    } else {
        if ( $_POST['type'] == 'name' ) {
            if ( !empty($_POST['user_new_name']) ) {
                $userdata = array(
                    'ID' => $user_id,
                    'display_name' => $_POST['user_new_name'],
                );
                wp_update_user($userdata);
                $error['class'] = 'success';
                $error['value'] = $_POST['user_new_name'];
                $error['notise'] = __('Name changed successfully', 'tripinglamp');
            } else {
                $error['class'] = 'error';
                $error['notise'] = __('Fill in the field', 'tripinglamp');
            }
        }

        if ( $_POST['type'] == 'email' ) {
            if ( !empty($_POST['user_new_email']) ) {
                if ( is_email( $_POST['user_new_email'] ) ) {
                    if ( !email_exists( $_POST['user_new_email'] ) ) {
                        $userdata = array(
                            'ID' => $user_id,
                            'user_email' => $_POST['user_new_email']
                        );
                        wp_update_user($userdata);
                        $error['class'] = 'success';
                        $error['notise'] = __('E-mail changed successfully', 'tripinglamp');
                    } else {
                        $error['class'] = 'error';
                        $error['notise'] = __('There is already a user on the site with this E-mail', 'tripinglamp');
                    }
                } else {
                    $error['class'] = 'error';
                    $error['notise'] = __('Please enter correct E-mail', 'tripinglamp');
                }
            } else {
                $error['class'] = 'error';
                $error['notise'] = __('Fill in the field', 'tripinglamp');
            }
        }

        if ( $_POST['type'] == 'pass' ) {
            if ( !empty($_POST['user_pass_curr']) ) {
                $user = get_user_by('id', $user_id);
                $hash = $user->data->user_pass;
                if ( wp_check_password( $_POST['user_pass_curr'], $hash ) ) {
                    $verifi_user_pass_change = time();
                    update_user_meta( $user_id, 'verifi_user_pass_change', $verifi_user_pass_change );
                    $error['class'] = 'success';
                    $error['verifi_user_pass_change'] = $verifi_user_pass_change;
                } else {
                    $error['class'] = 'error';
                    $error['notise'] = __('You have entered an incorrect password', 'tripinglamp');
                }
            } else {
                $error['class'] = 'error';
                $error['notise'] = __('Fill in the field', 'tripinglamp');
            }
        }

        if ( $_POST['type'] == 'pass_new' ) {
            if ( !empty($_POST['verifi']) ) {
                $verifi_user_pass_change = get_user_meta( $user_id, 'verifi_user_pass_change', true );
                if ( $_POST['verifi'] == $verifi_user_pass_change ) {
                    if ( !empty($_POST['user_pass']) && !empty($_POST['new_password_again']) ) {
                        if ($_POST['user_pass'] == $_POST['new_password_again']) {
                            $user = get_user_by('id', $user_id);
                            reset_password( $user, $user_pass );
                            $error['class'] = 'success';
                            $error['notise'] = __('Password changed successfully', 'tripinglamp');
                        } else {
                            $error['class'] = 'error';
                            $error['user_pass_inputs_no'] = __('Password mismatch', 'tripinglamp');
                        }
                    } else {
                        $error['class'] = 'error';
                        $error['user_pass_no'] = __('Fill in all the fields', 'tripinglamp');
                    }
                } else {
                    $error['class'] = 'error';
                    $error['verifi_error'] = __('Error, please try again later', 'tripinglamp');
                }
            } else {
                $error['class'] = 'error';
                $error['verifi'] = __('Error, please try again later', 'tripinglamp');
            }
        }

        // $error['class'] = $_POST;
        // $error['notise'] = __('Password changed successfully', 'tripinglamp');
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    }
}

function tripinglamp_user_glemp() {
    global $post, $user_ID;

    $glampings = get_posts( [
        'posts_per_page' => 10,
        'author' => $user_ID,
        'post_type' => 'glampings',
    ] );

    if ($glampings) {
        foreach( $glampings as $post ){
            setup_postdata( $post );
            ?>
            <div class="dashboard__user-glemp__elem">
                <span><?php the_title(); ?></span>
                <span><?php echo $post->views; ?></span>
                <a href="<?php the_permalink(); ?>" target="_blank">Смотреть</a>
                <a href="/postedit/?glemp-edit=<?php echo $post->ID; ?>">Редактировать</a>
            </div>
            <?php
        }
    } else {
        ?>
        <div class="dashboard__user-glemp__no-elem">Нет глэмпингов</div>
        <?php
    }
    wp_reset_postdata();
}
