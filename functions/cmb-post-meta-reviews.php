<?php
add_action( 'cmb2_init', 'register_reviews_metabox' );
function register_reviews_metabox() {
	$single_glampings = new_cmb2_box( array(
		'id'           => 'single_reviews',
		'title'        => esc_html__( 'Характеристики отзыва', 'glamping-club' ),
		'object_types' => array( 'reviews' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
        'classes'      => 'flex-box',
		'hookup' => false,
        'save_fields' => false
	) );

	$single_glampings->add_field( array(
		'name' => __( 'Описание глэмпинга <span class="required">*</span>', 'glamping-club' ),
		// 'desc' => esc_html__( 'Год постройки глэмпинга', 'glamping-club' ),
		'id'   => 'reviews_description',
		'type' => 'wysiwyg',
        'classes' => 'glc-form-group',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
            'textarea_name' => 'reviews_description',
            'textarea_rows' => 6,
            'quicktags' => false
        ),
		'show_on_cb' => 'reviews_description_only_show_for_front'
	) );

	$single_glampings->add_field( array(
		'name' => esc_html__( 'Фото', 'glamping-club' ),
		// 'desc' => esc_html__( 'Год постройки глэмпинга', 'glamping-club' ),
		'id'   => 'media_gallery',
		'type' => 'file_list',
		'preview_size' => array( 100, 100 ),
		'options' => array(
			'url' => false, // Hide the text input for the url
		),
	) );
}

function reviews_description_only_show_for_front() {
	return 1 != is_admin();
}
