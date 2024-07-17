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

    $main_options->add_field( array(
		'name'    => esc_html__( 'E-mail от которого отправлять письма пользователям', 'glamping-club' ),
		'desc'    => esc_html__( 'например admin@site.ru', 'glamping-club' ),
		'id'      => 'from_email',
		'type'    => 'text'
	) );

    $main_options->add_field( array(
		'name'    => esc_html__( 'Ключ API Яндекс карт', 'glamping-club' ),
		// 'desc'    => esc_html__( 'например admin@site.ru', 'glamping-club' ),
		'id'      => 'yandex_map_key',
		'type'    => 'text',
        'default' => 0
	) );

    $main_options->add_field( array(
		'name'    => esc_html__( 'Яндекс zoom', 'glamping-club' ),
		'desc'    => esc_html__( 'Масштаб карты для глэмпинга', 'glamping-club' ),
		'id'      => 'yand_zoom',
		'type'    => 'text',
        'attributes' => array(
			'type' => 'number',
			'min'  => '1',
		),
        'default' => 12
	) );

	/**
	 * Registers secondary options page, and set main item as parent.
	 */
	// $secondary_options = new_cmb2_box( array(
	// 	'id'           => 'glc_secondary_options_page',
	// 	'title'        => esc_html__( 'Развлечения', 'glamping-club' ),
	// 	'object_types' => array( 'options-page' ),
	// 	'option_key'   => 'glc_secondary_options',
	// 	'parent_slug'  => 'glc_options',
	// ) );
    //
    // $acc_options_group = $secondary_options->add_field( array(
	// 	'id'          => 'acc_options',
	// 	'type'        => 'group',
	// 	// 'description' => esc_html__( 'Группа полей', 'glamping-club' ),
	// 	// 'repeatable'  => false,
	// 	'options'     => array(
	// 		'group_title'    => esc_html__( 'Вариант развлечения', 'cmb2' ),
	// 		'add_button'     => __( 'Добавить вариант развлечения', 'cmb2' ),
	// 		'remove_button'  => __( 'Удалить вариант развлечения', 'cmb2' ),
	// 		'sortable'       => true,
	// 		'closed'         => true
	// 	),
	// ) );
    //
	// $secondary_options->add_group_field( $acc_options_group, array(
	// 	'name' => esc_html__( 'Название варианта развлечения', 'glamping-club' ),
	// 	// 'desc' => esc_html__( 'Год постройки глэмпинга', 'glamping-club' ),
	// 	'id'   => 'title',
	// 	'type' => 'text',
	// ) );

	/**
	 * Registers tertiary options page, and set main item as parent.
	 */
	// $tertiary_options = new_cmb2_box( array(
	// 	'id'           => 'glc_tertiary_options_page',
	// 	'title'        => esc_html__( 'Tertiary Options', 'glamping-club' ),
	// 	'object_types' => array( 'options-page' ),
	// 	'option_key'   => 'glc_tertiary_options',
	// 	'parent_slug'  => 'glc_options',
	// ) );
    //
	// $tertiary_options->add_field( array(
	// 	'name' => esc_html__( 'Поле для html', 'glamping-club' ),
	// 	'desc' => esc_html__( 'field description (optional)', 'glamping-club' ),
	// 	'id'   => 'textarea_code',
	// 	'type' => 'textarea_code',
	// ) );

}


// add_action( 'cmb2_save_options-page_fields_glamping_club_secondary_options_page', 'hook_secondary_options_page' );
function hook_secondary_options_page($object_id) {
    $admin_option = (object) get_option('glamping_club_secondary_options');
    // if ($admin_option->radio == 'option2') {
    //     update_option( 'glamping_club_tertiary_options', $admin_option->radio );
    // }
    update_option( 'glamping_club_tertiary_options', ['textarea_code' => $admin_option->radio] );
}
