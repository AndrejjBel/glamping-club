<?php
add_action( 'cmb2_init', 'register_single_stocks_metabox' );
function register_single_stocks_metabox() {
	$single_stocks = new_cmb2_box( array(
		'id'           => 'single_stocks',
		'title'        => esc_html__( 'Условия акции', 'glamping-club' ),
		'object_types' => array( 'stocks' ),
		'context'      => 'normal',
		'priority'     => 'high',
        'classes'      => 'flex-box',
		'show_in_rest' => true
	) );

	$single_stocks->add_field( array(
		'id'               => 'parent_glemp',
		'name'             => esc_html__( 'Глэмпинг', 'glamping-club' ),
		'desc' => esc_html__( 'Выберите глэмпинг для которого действует акция', 'glamping-club' ),
		'type'             => 'select',
		'show_option_none' => __( 'Выберите глэмпинг', 'glamping-club' ),
		'options_cb' => 'show_glemp_options',
	) );

	$single_stocks->add_field( array(
		'name' => __( 'Срок действия', 'glamping-club' ),
		'id'   => 'validity_period',
		'type' => 'textarea_small',
        'classes' => 'glc-form-group'
	) );

	$single_stocks->add_field( array(
		'name' => __( 'Дата начала акции', 'glamping-club' ),
		'desc' => esc_html__( 'Если укажете, с этой даты начнутся показы акции', 'glamping-club' ),
		'id'   => 'start_date',
		'type' => 'text_date_timestamp',
		// 'timezone_meta_key' => 'wiki_test_timezone',
		'date_format' => 'd/m/Y',
	) );

	$single_stocks->add_field( array(
		'name' => __( 'Дата окончания акции', 'glamping-club' ),
		'desc' => esc_html__( 'Если укажете, с этой даты завершатся показы акции', 'glamping-club' ),
		'id'   => 'end_date',
		'type' => 'text_date_timestamp',
		'date_format' => 'd/m/Y',
	) );
}

function show_glemp_options() {
	$args = array(
        'post_type' => 'glampings',
        'post_status' => 'publish',
        'posts_per_page' => -1,
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

add_filter( 'manage_' . 'stocks' . '_posts_columns', 'add_stocks_column', 4 );
function add_stocks_column( $columns ) {
	$num = 2; // после какой по счету колонки вставлять новые

	$new_columns = [
		'parent_glemp' => 'Глэмпинг',
	];

	return array_slice( $columns, 0, $num ) + $new_columns + array_slice( $columns, $num );
}

add_action( 'manage_' . 'stocks' . '_posts_custom_column', 'fill_stocks_column', 5, 2 );
function fill_stocks_column( $colname, $post_id ) {
	if( $colname === 'parent_glemp' ){
		$parent_glemp = get_post_meta( $post_id, 'parent_glemp', 1 );
		$title = get_the_title( $parent_glemp );
		$link = get_permalink( $parent_glemp );
		echo '<a href="' . $link . '">' . $title . '</a>';
	}
}
