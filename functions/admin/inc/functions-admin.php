<?php
// Рекомендован глэмпинг
add_action('wp_ajax_glamping_meta_update', 'admin_glamping_meta_update');
function admin_glamping_meta_update() {
    $value_new = '';
    if ($_POST['post_meta'] == 'glamping_recommended') {
        if ($_POST['meta_value'] == 'true') {
            $value_new = 'yes';
        } elseif ($_POST['meta_value'] == 'false') {
            $value_new = 'no';
        }
    }
    update_post_meta( $_POST['post_id'], $_POST['post_meta'], $value_new );
    $post_form = json_encode($_POST, JSON_UNESCAPED_UNICODE);
    echo $post_form;
    wp_die();
}
