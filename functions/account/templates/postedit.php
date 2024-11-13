<?php
$cur_user_id = get_current_user_id();
$post_id = '';
if (!empty($_GET['post-type'])) {
    if ($_GET['post-type'] == 'glampings') {
        if (!empty($_GET['glc-postid'])) {
            $post_id = (int)$_GET['glc-postid'];
            $post_glamp = get_post( $post_id );

            if ($post_glamp) {
                if ($post_glamp->post_type == 'glampings' && $cur_user_id == $post_glamp->post_author) {
                    cmb2_metabox_form( 'single_glampings_front', $post_id );
                    cmb2_metabox_form( 'media_gallery_front', $post_id );
                    echo '<h5>Варианты размещения</h5>';
                    cmb2_metabox_form( 'accommodation_options_front', $post_id );
                    echo '<h5>Часто задаваемые вопросы</h5>';
                    cmb2_metabox_form( 'faq_options_front', $post_id );
                    echo '<h5>Чем заняться</h5>';
                    cmb2_metabox_form( 'wtd_options', $post_id );
                    echo '<div class="glc-postedit-btn-edit">
                        <button id="btn-edit" class="primary w100 js-btn-add-edit" data-type="edit" type="button" name="button">Сохранить</button>
                    </div>';
                } else {
                    echo '<script type="text/javascript">window.location.href = "/dashboard/"</script>';
                }
            } else {
                echo '<script type="text/javascript">window.location.href = "/dashboard/"</script>';
            }
        } else {
            cmb2_metabox_form( 'single_glampings_front' );
            cmb2_metabox_form( 'media_gallery_front' );
            echo '<h5>Варианты размещения</h5>';
            cmb2_metabox_form( 'accommodation_options_front' );
            echo '<h5>Часто задаваемые вопросы</h5>';
            cmb2_metabox_form( 'faq_options_front' );
            echo '<h5>Чем заняться</h5>';
            cmb2_metabox_form( 'wtd_options' );
            echo '<div class="glc-postedit-btn-edit">
                <button id="btn-add" class="primary w100 js-btn-add-edit" data-type="add" type="button" name="button">Сохранить</button>
            </div>';
        }
    } elseif ($_GET['post-type'] == 'stocks') {
        if (!empty($_GET['glc-postid'])) {
            $post_id = (int)$_GET['glc-postid'];
            $post_stocks = get_post( $post_id );

            if ($post_stocks) {
                if ($post_stocks->post_type == 'stocks' && $cur_user_id == $post_stocks->post_author) {
                    cmb2_metabox_form( 'single_stocks_front', $post_id );
                    cmb2_metabox_form( 'single_stocks_dates_front', $post_id );
                    echo '<div class="glc-postedit-btn-edit">
                        <button id="btn-add" class="primary w100 js-btn-add-edit-stocks" data-type="edit-stocks" type="button" name="button">Сохранить</button>
                    </div>';
                } else {
                    echo '<script type="text/javascript">window.location.href = "/dashboard/"</script>';
                }
            } else {
                echo '<script type="text/javascript">window.location.href = "/dashboard/"</script>';
            }
        } else {
            cmb2_metabox_form( 'single_stocks_front' );
            cmb2_metabox_form( 'single_stocks_dates_front' );
            echo '<div class="glc-postedit-btn-edit">
                <button id="btn-add" class="primary w100 js-btn-add-edit-stocks" data-type="add-stocks" type="button" name="button">Сохранить</button>
            </div>';
        }
    }
}
