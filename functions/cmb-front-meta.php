<?php
add_action( 'cmb2_init', 'register_front_page_metabox' );
function register_front_page_metabox() {
	$front_page = new_cmb2_box( array(
		'id'           => 'front_page',
		'title'        => esc_html__( 'Настройки', 'glamping-club' ),
		'object_types' => array( 'page' ), // post type
		'show_on'      => array( 'key' => 'front-page', 'value' => '' ),
		'context'      => 'normal', //  'normal', 'advanced', or 'side'
		'context'      => 'normal',
		'priority'     => 'high',
        'classes'      => 'flex-box'
	) );

	$first_screen = $front_page->add_field( array(
		'id'          => 'front_page',
		'type'        => 'group',
		'repeatable'  => false,
		'options'     => array(
			'group_title'    => esc_html__( 'Дополнительно', 'cmb2' ),
			'closed'         => true
		),
	) );

	$front_page->add_group_field( $first_screen, array(
		'name' => esc_html__( 'Заголовок Первого экрана', 'glamping-club' ),
		'id' => 'hero_title',
		'type' => 'textarea_small'
	) );

	$front_page->add_group_field( $first_screen, array(
		'name' => esc_html__( 'Заголовок последнего экрана', 'glamping-club' ),
		'id' => 'end_title',
		'type' => 'textarea_small'
	) );

	$front_page->add_group_field( $first_screen, array(
		'name' => esc_html__( 'Картинка последнего экрана', 'glamping-club' ),
		'id'   => 'end_img',
		'type' => 'file',
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
		'preview_size' => array( 220, 220 )
	) );

	$front_page->add_group_field( $first_screen, array(
		'name' => esc_html__( 'Текст 1 последнего экрана', 'glamping-club' ),
		'id' => 'end_text1',
		'type' => 'textarea_small'
	) );

	$front_page->add_group_field( $first_screen, array(
		'name' => esc_html__( 'Текст 2 последнего экрана', 'glamping-club' ),
		'id' => 'end_text2',
		'type' => 'textarea_small'
	) );

	$front_page->add_group_field( $first_screen, array(
		'name' => esc_html__( 'Текст 3 последнего экрана', 'glamping-club' ),
		'id' => 'end_text3',
		'type' => 'textarea_small'
	) );
}

function ed_metabox_include_front_page( $display, $meta_box ) {
	if ( ! isset( $meta_box['show_on']['key'] ) ) {
		return $display;
	}
	if ( 'front-page' !== $meta_box['show_on']['key'] ) {
		return $display;
	}
	$post_id = 0;
	if ( isset( $_GET['post'] ) ) {
		$post_id = $_GET['post'];
	} elseif ( isset( $_POST['post_ID'] ) ) {
		$post_id = $_POST['post_ID'];
	}
	if ( ! $post_id ) {
		return false;
	}
	$front_page = get_option( 'page_on_front' );
	return $post_id == $front_page;
}
add_filter( 'cmb2_show_on', 'ed_metabox_include_front_page', 10, 2 );
