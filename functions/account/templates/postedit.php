<?php
$cur_user_id = get_current_user_id();
$post_id = '';
if (!empty($_GET['glc-postid'])) {
    $post_id = (int)$_GET['glc-postid'];
    $post_glamp = get_post( $post_id );

    if ($cur_user_id == $post_glamp->post_author) {
        cmb2_metabox_form( 'single_glampings_front', $post_id );

        cmb2_metabox_form( 'media_gallery_front', $post_id );

        cmb2_metabox_form( 'accommodation_options_front', $post_id );
    } else {
        echo '<script type="text/javascript">window.location.href = "/"</script>';
    }
} else {
    cmb2_metabox_form( 'single_glampings_front' );

    cmb2_metabox_form( 'media_gallery_front' );

    cmb2_metabox_form( 'accommodation_options_front' );
}
