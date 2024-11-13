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

	// $single_glampings->add_field( array(
	// 	'name' => __( 'Описание отзыва <span class="required">*</span>', 'glamping-club' ),
	// 	// 'desc' => esc_html__( 'Год постройки глэмпинга', 'glamping-club' ),
	// 	'id'   => 'reviews_description',
	// 	'type' => 'wysiwyg',
    //     'classes' => 'glc-form-reviews',
    //     'options' => array(
    //         'wpautop' => true,
    //         'media_buttons' => false,
    //         'textarea_name' => 'reviews_description',
    //         'textarea_rows' => 6,
    //         'quicktags' => false,
	// 		'teeny' => true
    //     ),
	// 	'show_on_cb' => 'reviews_description_only_show_for_front'
	// ) );

	$single_glampings->add_field( array(
		'name' => esc_html__( 'Фото', 'glamping-club' ),
		// 'desc' => esc_html__( 'Год постройки глэмпинга', 'glamping-club' ),
		'id'   => 'reviews_media_gallery',
		'type' => 'file_list',
		'preview_size' => array( 100, 100 ),
		'options' => array(
			'url' => false, // Hide the text input for the url
		),
		'classes' => 'glc-form-reviews',
		'query_args' => array(
			'author' => get_current_user_id()
		),
	) );
}

function reviews_description_only_show_for_front() {
	return 1 != is_admin();
}

function filter_quicktags_settings( $qtinit, $editor_id ){
	if( $editor_id == 'reviews_description' ){
		$mce_teeny = [
			'bold', 'italic', 'underline', 'strikethrough', 'undo', 'redo'
		];
		// Определяем набор кнопок
		$qtinit = $mce_teeny;

	}
	return $qtinit;
}
add_filter('teeny_mce_buttons', 'filter_quicktags_settings', 10, 2);

add_filter( 'manage_' . 'reviews' . '_posts_columns', 'add_reviews_column', 4 );
function add_reviews_column( $columns ) {
	$num = 2; // после какой по счету колонки вставлять новые

	$new_columns = [
		'parent_glemp' => 'Глэмпинг',
	];

	return array_slice( $columns, 0, $num ) + $new_columns + array_slice( $columns, $num );
}

add_action( 'manage_' . 'reviews' . '_posts_custom_column', 'fill_reviews_column', 5, 2 );
function fill_reviews_column( $colname, $post_id ) {
	if( $colname === 'parent_glemp' ){
		$parent_glemp = get_post_meta( $post_id, 'glempid', 1 );
		$title = get_the_title( $parent_glemp );
		$link = get_permalink( $parent_glemp );
		echo '<a href="' . $link . '">' . $title . '</a>';
	}
}
