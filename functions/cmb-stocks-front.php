<?php
if ( !is_admin() ) {
	add_action( 'cmb2_init', 'register_single_stocks_metabox_front' );
}
function register_single_stocks_metabox_front() {
	$single_stocks = new_cmb2_box( array(
		'id'           => 'single_stocks_front',
		'title'        => esc_html__( 'Условия акции', 'glamping-club' ),
		'object_types' => array( 'stocks' ),
		'context'      => 'normal',
		'priority'     => 'high',
        'classes'      => 'glc-flex-box',
		'show_in_rest' => true
	) );

	$single_stocks->add_field( array(
		'id'               => 'parent_glemp',
		'name'             => esc_html__( 'Глэмпинг', 'glamping-club' ),
		'desc' => esc_html__( 'Выберите глэмпинг для которого действует акция', 'glamping-club' ),
		'type'             => 'select',
		'classes' => 'glc-form-group-select',
		'show_option_none' => __( 'Выберите глэмпинг', 'glamping-club' ),
		'options_cb' => 'show_glemp_options_front',
	) );

	$single_stocks->add_field( array(
		'name' => __( 'Заголовок <span class="required">*</span>', 'glamping-club' ),
		'id'   => 'stock_title',
		'type' => 'text',
        'classes' => 'glc-form-group',
        'default_cb' => 'set_to_stock_title',
        'attributes'  => array(
            'required'    => 'required',
			'data-valid' => 'required-field'
        )
	) );

	$single_stocks->add_field( array(
		'name' => __( 'Срок действия <span class="required">*</span>', 'glamping-club' ),
		'id'   => 'validity_period',
		'type' => 'textarea_small',
        'classes' => 'glc-form-group'
	) );

	$single_stocks->add_field( array(
		'name' => __( 'Описание глэмпинга <span class="required">*</span>', 'glamping-club' ),
		// 'desc' => esc_html__( 'Год постройки глэмпинга', 'glamping-club' ),
		'id'   => 'stock_description',
		'type' => 'wysiwyg',
        'classes' => 'glc-form-group',
        'default_cb' => 'set_to_stock_content',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
            'textarea_name' => 'stock_description',
            'textarea_rows' => 6,
            'quicktags' => false
        ),
	) );

	$single_stocks_dates = new_cmb2_box( array(
		'id'           => 'single_stocks_dates_front',
		'title'        => esc_html__( 'Условия акции', 'glamping-club' ),
		'object_types' => array( 'stocks' ),
		'context'      => 'normal',
		'priority'     => 'high',
        'classes'      => 'glc-flex-box two-columns',
		'show_in_rest' => true
	) );

	$single_stocks_dates->add_field( array(
		'name' => __( 'Дата начала акции', 'glamping-club' ),
		'desc' => esc_html__( 'Если укажете, с этой даты начнутся показы акции', 'glamping-club' ),
		'id'   => 'start_date',
		'type' => 'text_date_timestamp',
		// 'timezone_meta_key' => 'wiki_test_timezone',
		'date_format' => 'd/m/Y',
		'classes' => 'glc-form-group two-columns-item',
	) );

	$single_stocks_dates->add_field( array(
		'name' => __( 'Дата окончания акции', 'glamping-club' ),
		'desc' => esc_html__( 'Если укажете, с этой даты завершатся показы акции', 'glamping-club' ),
		'id'   => 'end_date',
		'type' => 'text_date_timestamp',
		'date_format' => 'd/m/Y',
		'classes' => 'glc-form-group two-columns-item',
	) );
}

function show_glemp_options_front() {
	$args = array(
        'post_type' => 'glampings',
        'post_status' => 'publish',
        'posts_per_page' => -1,
		'author' => get_current_user_id(),
        'orderby' => 'name',
        'order' => 'ASC',
    );
    $gl_posts = get_posts( $args );
	$gl_obj = [];
	foreach ($gl_posts as $gl_post) {
		$gl_obj[$gl_post->ID] = $gl_post->post_title;
	}
	return $gl_obj;
}

function set_to_stock_title($field_args, $field) {
    $post = get_post( $field->object_id );
    $title = '';
    if ($post->post_type == 'stocks') {
        $title = get_the_title( $field->object_id );
    }
    return $title;
}

function set_to_stock_content($field_args, $field) {
    $post = get_post( $field->object_id );
    $content = '';
    if ($post->post_type == 'stocks') {
        $content = $post->post_content;
    }
    return $content;
}

function hook_stocks_parent_glampings( $post_id, $updated, $cmb ) {
	$post = get_post($post_id);
	if ( $post->post_type == 'stocks' ) {
		$args = array(
	        'post_type' => 'stocks',
	        'post_status' => 'publish',
	        'posts_per_page' => -1,
			'meta_query' => [ [
				'key' => 'parent_glemp',
				'value' => $post->parent_glemp,
			] ],
			'fields' => 'ids'
	    );
	    $stocks = get_posts( $args );

		if (count($stocks)) {
			update_post_meta( $post->parent_glemp, 'stocks', $stocks);
		} else {
			delete_post_meta( $post->parent_glemp, 'stocks' );
		}
	}
}
add_action( 'cmb2_save_post_fields_single_stocks', 'hook_stocks_parent_glampings', 10, 3 );

function stocks_parent_glampings_add( $post_id ) {
	$post = get_post($post_id);
	if ( $post->post_type == 'stocks' ) {
		$args = array(
	        'post_type' => 'stocks',
	        'post_status' => 'publish',
	        'posts_per_page' => -1,
			'meta_query' => [ [
				'key' => 'parent_glemp',
				'value' => $post->parent_glemp,
			] ],
			'fields' => 'ids'
	    );
	    $stocks = get_posts( $args );

		if (count($stocks)) {
			update_post_meta( $post->parent_glemp, 'stocks', $stocks);
		} else {
			delete_post_meta( $post->parent_glemp, 'stocks' );
		}
	}
}
add_action( 'save_post_stocks', 'stocks_parent_glampings_add' );
