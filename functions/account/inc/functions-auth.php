<?php
add_action( 'init', 'glamping_club_noadmin' );
function glamping_club_noadmin() {
	if ( is_admin() && !current_user_can('administrator') && !wp_doing_ajax() ) {
		wp_redirect( home_url( '/' . PAGE_LOGIN . '/' ) );
		exit;
	}
}

function glamping_club_custom_login_page() {
  $new_login_page_url = home_url( '/' . PAGE_LOGIN . '/' ); // new login page
  global $pagenow;
  if( $pagenow == 'wp-login.php' && $_SERVER['REQUEST_METHOD'] == 'GET'  && !wp_doing_ajax() ) {
    wp_redirect( $new_login_page_url );
    exit;
  }
}
if( !is_user_logged_in() ){
  add_action('init', 'glamping_club_custom_login_page');
}

add_action( 'template_redirect', 'glamping_club_template_redirect' );
function glamping_club_template_redirect(){
    if( is_page( array(PAGE_LOGIN, PAGE_REGISTRATION, PAGE_FORGOT_PASSWORD) ) && is_user_logged_in() ){
        wp_redirect( home_url( '/' . PAGE_DASHBOARD . '/' ) );
        exit();
    } elseif (is_page(PAGE_DASHBOARD)  && !is_user_logged_in()) {
        wp_redirect( home_url( '/' ) );
        exit();
    }
}

// Leave the user on the same page when entering an incorrect login/password in the authorization form wp_login_form()
add_action( 'wp_login_failed', 'glamping_club_front_end_login_fail' );
function glamping_club_front_end_login_fail( $username ) {
    $login_page  = home_url( '/login/' );
    wp_redirect( $login_page . '?login=failed' );
}

function verify_username_password( $user, $username, $password ) {
    $login_page  = home_url( '/login/' );
    if( $username == "" || $password == "" ) {
        wp_redirect( $login_page . "?login=empty" );
        exit;
    }
}
add_filter( 'authenticate', 'verify_username_password', 1, 3);

// Двухфакторная аутентификация email
add_action( 'wp_authenticate_user', 'glamping_club_authenticate_action', 10, 2 );
function glamping_club_authenticate_action( $user, $password ){
    $user_identified = get_user_meta( $user->ID, 'user_identified', true );
    if (!$user_identified || $user_identified == 'no') {
        remove_query_arg( 'login-error' );
        wp_redirect( add_query_arg('user_identified', 'failed', '/login/' ) );
        exit;
    } else {
        return $user;
    }
}

function glamping_club_verifi_email() {
    $style_warn = ' style="display:none;"';
    $text_warn = '';
    if ( $_GET ) {
    	if ( isset( $_GET["login"] ) ) {
            if ( $_GET["login"] == 'failed' ) {
                $style_warn = ' login-error';
        		$text_warn = __( 'Указан неверный логин или пароль', 'tripinglamp' );
            } elseif ( $_GET["login"] == 'empty' ) {
                $style_warn = ' login-error';
        		$text_warn = __( 'Введите логин и пароль', 'tripinglamp' );
            }
    	} elseif ( isset( $_GET['verifi'] ) ) {
    		if ( $_GET["verifi"] == '1' && isset( $_REQUEST['email'] ) && isset( $_REQUEST['user_login'] ) && isset( $_REQUEST['key'] ) ) {
    		    $user = check_password_reset_key( $_REQUEST['key'], $_REQUEST['user_login'] );
    		    if ( $user ) {
    		        update_user_meta( $user->ID, 'user_identified', 'yes' );
    			}
    		}
    	} elseif ( isset( $_GET["user_identified"] ) ) {
            if ( $_GET["user_identified"] == 'failed' ) {
                $style_warn = ' login-error';
        		$text_warn = __( 'Подтвердите весь свой E-mail, перейдя по ссылке из письма.', 'tripinglamp' );
            }
    	}
    }
    return ['style_warn'=>$style_warn, 'text_warn'=>$text_warn];
}

// Adding an Email check field
add_action( 'show_user_profile', 'glamping_club_profile_fields' );
add_action( 'edit_user_profile', 'glamping_club_profile_fields' );
function glamping_club_profile_fields( $user ) {
    echo '<h3>Additionally</h3>';
    echo '<table class="form-table">';

    $user_identified = ( $user_identified = get_the_author_meta( 'user_identified', $user->ID ) ) ? $user_identified : 'no';
 	echo '<tr><th><label for="user_identified">Email check</label></th>
 		<td><ul>
 			<li><label><input value="no" name="user_identified"' . checked( $user_identified, 'no', false ) . ' type="radio" /> No</label></li>
 			<li><label><input value="yes" name="user_identified"' . checked( $user_identified, 'yes', false ) . ' type="radio" /> Yes</label></li>
 		</ul></td>
 	</tr>';
    echo '</table>';
}
// Save the Email check field
add_action( 'personal_options_update', 'glamping_club_save_profile_fields' );
add_action( 'edit_user_profile_update', 'glamping_club_save_profile_fields' );
function glamping_club_save_profile_fields( $user_id ) {
    if ( $_POST[ 'user_identified' ] ) {
        update_user_meta( $user_id, 'user_identified', sanitize_text_field( $_POST[ 'user_identified' ] ) );
    }
}

// Adding columns to the user list
add_filter( 'manage_users_columns', 'glamping_club_user_custom_column' );
function glamping_club_user_custom_column( $columns ) {
    $columns[ 'user_identified' ] = 'Email check';
    // $columns[ 'account_type' ] = 'Account type';
    // $columns[ 'parent_user' ] = 'Parent user';
    $columns[ 'registration_date' ] = 'Date of registration';
    return $columns;
}

add_filter( 'manage_users_custom_column', 'glamping_club_user_custom_column_content', 25, 3 );
function glamping_club_user_custom_column_content( $row_output, $column_id, $user ) {
    if( 'user_identified' == $column_id ) {
        $user_identified = get_the_author_meta( 'user_identified', $user );
        if ( $user_identified != 'yes' ) {
            return '<span style="color:red; font-weight:600; text-transform:uppercase;">NO</span>';
        } else {
            return 'Yes';
        }

    }
    if( 'registration_date' == $column_id ) {
        $registered_date = get_the_author_meta( 'registered', $user );
        return wp_date( 'H:i:s - j-m-Y', strtotime($registered_date) );
    }
    return $row_output;
}

// Регистрация пользователей
add_action('wp_ajax_reg_user', 'glamping_club_reg_user');
add_action('wp_ajax_nopriv_reg_user', 'glamping_club_reg_user');
function glamping_club_reg_user() {
    $error = array();

    if ( !wp_verify_nonce( $_POST['nonce'], 'glamping_club' ) ) {
        $error['empty_nonce'] = __( 'Problems encountered, try again later.', 'glamping-club' );
    }
    if ( !$_POST['user_name'] ) {
        $error['user_name'] = __( 'Заполните поле Имя', 'glamping-club' );
    }
    // if ( email_exists( $_POST['user_email'] ) ) {
    //     $error['yes_email'] = __( 'The user with the specified E-mail is already registered.', 'strojdo' );
    // }
	if ( !$_POST['user_email'] ) {
        $error['email_error'] = __( 'Заполните поле E-mail', 'glamping-club' );
    } elseif ( !is_email( $_POST['user_email'] ) ) {
    	$error['email_error'] = __( 'Указан некорректный E-mail', 'glamping-club' );
    } elseif ( email_exists( $_POST['user_email']) ) {
    	$error['yes_email'] = __( 'Пользователь с указанным E-mail уже зарегистрирован', 'glamping-club' );
    }
    if ( !$_POST['pwd'] ) {
        $error['password_error'] = __( 'Заполните поле пароль', 'glamping-club' );
    }


    if ( count( $error ) > 0 ) {
        $error['class'] = 'errors';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    } else {
        if ( $_POST['user_nicename'] ) {
            if ( username_exists( $login ) ) {
                $login = '';
            } else {
                $login = $_POST['user_nicename'];
            }
        } else {
            // $login = '';
            $login = preg_replace("/^(.+?)@.+$/", '\\1', $_POST['user_email']);
        }
        if ( $_POST['pwd'] ) {
            $password = $_POST['pwd'];
        } else {
            $password = wp_generate_password();
        }

        $userdata = array(
            'user_login' => $_POST['user_name'],
            'user_pass' => $password,
            'user_email' => $_POST['user_email'],
            // 'nickname' => $login,
            'first_name' => $_POST['user_name'],
            'display_name' => $_POST['user_name'],
        );
        $user_id = wp_insert_user( $userdata ) ;

        if( ! is_wp_error( $user_id ) ){
            update_user_meta( $user_id, 'user_identified', 'no' );
            wp_new_user_notification( $user_id, '' );

            $user = get_user_by( 'email', $_POST['user_email'] );
            $key = get_password_reset_key( $user );
            $url = get_site_url( null, 'login/?verifi=1&key=' . $key . '&email=' . $_POST['user_email'] . '&user_login=' . $user->data->user_login );
            $site_name = get_bloginfo('name');
            $admin_email = get_bloginfo('admin_email');
            $mailTo = $_POST['user_email'];
            $subject = 'Регистрация на сайте ' . $site_name;
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=utf-8\r\n";
            $headers .= "From: admin@dinskinform.ru <admin@dinskinform.ru>\r\n";
            $email = 'E-mail: ' . $_POST['user_email'] . ' ';
            $login_user = 'Login: ' . $login . ' ';
            $pass = 'Пароль: ' . $password . ' ';
            $message = '<p>Вы успешно зарегистрировались на сайте ' . $site_name . '.</p>';
            $message .= '<p>Чтобы подтвердить свой адрес электронной почты, перейдите по ссылке ниже.: <a href="' . $url . '" target="blank">Подтвердить E-mail</a></p>';
            $message .= '<p>Ваши данные для авторизации:</p>';
            $msgotprav = $message ."<br>" . $email . "<br>" . $login_user . "<br>" . $pass . "<br>";
            wp_mail($mailTo, $subject, $msgotprav, $headers);

            $error['success_send_mail'] = __( 'На указанный адрес электронной почты отправлено письмо с инструкциями.', 'tripinglamp' );
            $error['class'] = 'success';
            // $error['post'] = $_POST;
            $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
            echo $error_fin;
        }
        else {
            $error['class'] = 'errors';
            $error['error_message'] = $user_id->get_error_message();
            $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
            echo $error_fin;
        }
        wp_die();
    }
}

// Checking E-mail when recovering a password
add_action('wp_ajax_emailverifi', 'glamping_club_email_verifi');
add_action('wp_ajax_nopriv_emailverifi', 'glamping_club_email_verifi');
function glamping_club_email_verifi() {
    // Получение отправленных данных
    $error = array();
    $user_email = esc_sql( $_POST['email_forgot'] );
    $nonce = esc_sql( $_POST['nonce'] );
    if ( !wp_verify_nonce( $nonce, 'glamping_club' ) ) {
        $error['empty_nonce'] = __('Ошибка запроса', 'glamping-club');
    }
    if ( !$user_email ) {
        $error['no_user_email'] = __('Заполните поле E-mail', 'glamping-club');
    }
    $user = get_user_by( 'email', $user_email );
    if ( $user_email && !$user ) {
        $error['no_user'] = __('Пользователь с указанными данными не зарегистрирован', 'glamping-club');
    }
    if ( count( $error ) > 0 ) {
        $error['class'] = 'errors';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
    } else {
        $key = get_password_reset_key( $user );
        $url = get_site_url( null, 'forgot/?new-pass=yes&key=' . $key . '&email=' . $user_email . '&login=' . $user->data->user_login );
        $subject = 'Запрос на сброс пароля: ';
        $headers= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "From: admin@dinskinform.ru <admin@dinskinform.ru>\r\n";
        $message = '<p>Кто-то запросил сброс пароля для следующей учетной записи:</p>';
        $message .= '<p>Название сайта: ' . get_bloginfo( 'name' ) . '</p>';
        $message .= '<p>Login: ' . $user->data->user_login . '</p>';
        $message .= '<p>Если не Вы отправляли запрос, просто проигнорируйте это письмо, и ничего не произойдет..</p>';
        $message .= '<p>Чтобы сбросить пароль, перейдите по следующей ссылке: <a href="' . $url . '" target="blank">Восстановить пароль</a></p>';
        $message .= "<p>Это письмо было создано автоматически. Вам не нужно на него отвечать.</p>";
        $message .= '<p>Thank you.</p>';
        wp_mail( $user_email, $subject, $message, $headers );
        $error['success_send_mail'] = __('На ваш адрес электронной почты было отправлено письмо с инструкциями..', 'glamping-club');
        $error['class'] = 'success_plus';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
    }
    wp_die();
}

// Change Password
add_action('wp_ajax_new_user_pass', 'glamping_club_recovery_pass');
add_action('wp_ajax_nopriv_new_user_pass', 'glamping_club_recovery_pass');
function glamping_club_recovery_pass () {
    $error = array();
    $key = $_POST['key'];
    $login = $_POST['login'];
    $user_pass = $_POST['user_pass'];
    $user = check_password_reset_key( $key, $login );
    if ( is_wp_error($user) ) {
        $error['empty_user'] = __('Ошибка идентификации', 'glamping-club');
    } else {
        if ( !$user_pass ) {
            $error['user_pass_no'] = __('Новый пароль не указан', 'glamping-club');
        }
    }
    $nonce = $_POST['nonce'];
    if ( !wp_verify_nonce( $nonce, 'glamping_club' ) ) {
        $error['empty_nonce'] = __('Ошибка. Повторите попытку позже.', 'glamping-club');
    }
    if ( count( $error ) > 0 ) {
        $error['class'] = 'errors';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    } else {
        reset_password( $user, $user_pass );
        $error['class'] = 'success';
        $error['notise'] = __('Пароль успешно изменен', 'glamping-club');
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    }
}

// add_filter( 'avatar_defaults', 'add_default_avatar_option' );
function add_default_avatar_option( $avatars ){
	$url = get_stylesheet_directory_uri() . '/account/img/def-image.png';
	$avatars[ $url ] = 'Аватар сайта';
	return $avatars;
}
