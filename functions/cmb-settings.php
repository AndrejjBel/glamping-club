<?php
add_action( 'cmb2_admin_init', 'glamping_club_register_main_options_metabox' );
function glamping_club_register_main_options_metabox() {
    $admin_email = get_option('admin_email');
	$main_options = new_cmb2_box( array(
		'id'           => 'glc_options_page',
		'title'        => esc_html__( 'Настройки сайта', 'glamping-club' ),
		'object_types' => array( 'options-page' ),
		'option_key'      => 'glc_options'
	) );

    $main_options->add_field( array(
        'name'             => esc_html__( 'Цвет сайта', 'glamping-club' ),
        'id'               => 'theme_color',
        'type'             => 'select',
        'default'          => 'theme-color-defolt',
        'options'          => array(
            'theme-color-defolt' => __( 'Синий', 'glamping-club' ),
            'theme-color-green'   => __( 'Зеленый', 'glamping-club' )
        ),
    ) );

    $main_options->add_field( array(
		'name'    => esc_html__( 'Контакты - заголовок', 'glamping-club' ),
		'desc'    => esc_html__( 'заголовок блока "Контакты"', 'glamping-club' ),
		'id'      => 'contact_title',
		'type'    => 'text',
        'default' => 'Контакты'
	) );

    $main_options->add_field( array(
		'name'    => esc_html__( 'Адрес', 'glamping-club' ),
		// 'desc'    => esc_html__( 'выбор основного цвета сайта', 'glamping-club' ),
		'id'      => 'address',
		'type'    => 'text',
        'default' => '142055, Москва, ул.Красная, 150'
	) );

    $main_options->add_field( array(
		'name'    => esc_html__( 'Почта для связи', 'glamping-club' ),
		'desc'    => esc_html__( 'показывается в подвале сайта', 'glamping-club' ),
		'id'      => 'contact_emails',
		'type'    => 'text',
        'repeatable'  => true,
	) );

    $main_options->add_field( array(
		'name'    => esc_html__( 'Телефон для связи', 'glamping-club' ),
		'desc'    => esc_html__( 'показывается в подвале сайта', 'glamping-club' ),
		'id'      => 'contact_phone',
		'type'    => 'text',
        'repeatable'  => true,
	) );

    $main_options->add_field( array(
		'name'    => esc_html__( 'Текст Copyrights', 'glamping-club' ),
		// 'desc'    => esc_html__( 'выбор основного цвета сайта', 'glamping-club' ),
		'id'      => 'copiright_text',
		'type'    => 'text'
	) );

	// $main_options->add_field( array(
	// 	'name'    => esc_html__( 'Основной цвет', 'glamping-club' ),
	// 	// 'desc'    => esc_html__( 'выбор основного цвета сайта', 'glamping-club' ),
	// 	'id'      => 'primary_color',
	// 	'type'    => 'colorpicker',
	// 	'default' => '#676767',
	// ) );
    //
    // $main_options->add_field( array(
	// 	'name'    => esc_html__( 'Дополнительный цвет 1', 'glamping-club' ),
	// 	// 'desc'    => esc_html__( 'выбор основного цвета сайта', 'glamping-club' ),
	// 	'id'      => 'dop_color1',
	// 	'type'    => 'colorpicker',
	// 	'default' => '#676767',
	// ) );
    //
    // $main_options->add_field( array(
	// 	'name'    => esc_html__( 'Дополнительный цвет 2', 'glamping-club' ),
	// 	// 'desc'    => esc_html__( 'выбор основного цвета сайта', 'glamping-club' ),
	// 	'id'      => 'dop_color2',
	// 	'type'    => 'colorpicker',
	// 	'default' => '#676767',
	// ) );
    //
    // $main_options->add_field( array(
	// 	'name'    => esc_html__( 'Дополнительный цвет 3', 'glamping-club' ),
	// 	// 'desc'    => esc_html__( 'выбор основного цвета сайта', 'glamping-club' ),
	// 	'id'      => 'dop_color3',
	// 	'type'    => 'colorpicker',
	// 	'default' => '#676767',
	// ) );
    //
    // $main_options->add_field( array(
	// 	'name'    => esc_html__( 'Дополнительный цвет 4', 'glamping-club' ),
	// 	// 'desc'    => esc_html__( 'выбор основного цвета сайта', 'glamping-club' ),
	// 	'id'      => 'dop_color4',
	// 	'type'    => 'colorpicker',
	// 	'default' => '#676767',
	// ) );
    //
    // $main_options->add_field( array(
	// 	'name'    => esc_html__( 'Дополнительный цвет 5', 'glamping-club' ),
	// 	// 'desc'    => esc_html__( 'выбор основного цвета сайта', 'glamping-club' ),
	// 	'id'      => 'dop_color5',
	// 	'type'    => 'colorpicker',
	// 	'default' => '#676767',
	// ) );

	/**
	 * Registers secondary options page, and set main item as parent.
	 */
	$secondary_options = new_cmb2_box( array(
		'id'           => 'glc_secondary_options_page',
		'title'        => esc_html__( 'Secondary Options', 'glamping-club' ),
		'object_types' => array( 'options-page' ),
		'option_key'   => 'glc_secondary_options',
		'parent_slug'  => 'glc_options',
	) );

	$secondary_options->add_field( array(
		'name'    => esc_html__( 'Радио кнопки', 'glamping-club' ),
		'desc'    => esc_html__( 'field description (optional)', 'glamping-club' ),
		'id'      => 'radio',
		'type'    => 'radio',
		'options' => array(
			'option1' => esc_html__( 'Option One', 'glamping-club' ),
			'option2' => esc_html__( 'Option Two', 'glamping-club' ),
			'option3' => esc_html__( 'Option Three', 'glamping-club' ),
		),
	) );

	/**
	 * Registers tertiary options page, and set main item as parent.
	 */
	$tertiary_options = new_cmb2_box( array(
		'id'           => 'glc_tertiary_options_page',
		'title'        => esc_html__( 'Tertiary Options', 'glamping-club' ),
		'object_types' => array( 'options-page' ),
		'option_key'   => 'glc_tertiary_options',
		'parent_slug'  => 'glc_options',
	) );

	$tertiary_options->add_field( array(
		'name' => esc_html__( 'Поле для html', 'glamping-club' ),
		'desc' => esc_html__( 'field description (optional)', 'glamping-club' ),
		'id'   => 'textarea_code',
		'type' => 'textarea_code',
	) );

}


// add_action( 'cmb2_save_options-page_fields_glamping_club_secondary_options_page', 'hook_secondary_options_page' );
function hook_secondary_options_page($object_id) {
    $admin_option = (object) get_option('glamping_club_secondary_options');
    // if ($admin_option->radio == 'option2') {
    //     update_option( 'glamping_club_tertiary_options', $admin_option->radio );
    // }
    update_option( 'glamping_club_tertiary_options', ['textarea_code' => $admin_option->radio] );
}
