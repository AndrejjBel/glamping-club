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

    $main_options->add_field( array(
		'name' => esc_html__( 'Заглушка фото глэмпинга', 'glamping-club' ),
		'desc' => esc_html__( 'Заглушка фото глэмпинга', 'glamping-club' ),
		'id'   => 'glamping_no_photo',
		'type' => 'file',
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
		// 'preview_size' => array( 220, 220 ),
        // 'classes' => 'glc-form-group glc-form-group-thumbnail',
        // 'default_cb' => 'set_to_post_thumbnail'
	) );

	/**
	 * Registers secondary options page, and set main item as parent.
	 */
	$alloptions_glamping_options = new_cmb2_box( array(
		'id'           => 'glc_alloptions_page',
		'title'        => esc_html__( 'Опции глэмпинга', 'glamping-club' ),
		'object_types' => array( 'options-page' ),
		'option_key'   => 'glc_alloptions_page',
		'parent_slug'  => 'glc_options',
	) );

    $glamping_type_group = $alloptions_glamping_options->add_field( array(
		'id'          => 'glamping_type',
		'type'        => 'group',
		'repeatable'  => false,
		'options'     => array(
			'group_title'    => esc_html__( 'Тип места', 'cmb2' ),
			'closed'         => true
		),
	) );

	$alloptions_glamping_options->add_group_field( $glamping_type_group, array(
		'name' => esc_html__( 'Название', 'glamping-club' ),
		// 'desc' => esc_html__( 'Название  Типа места', 'glamping-club' ),
		'id'   => 'title',
		'type' => 'text',
        'repeatable'  => true,
	) );

    $glamping_allocation_group = $alloptions_glamping_options->add_field( array(
		'id'          => 'glamping_allocation',
		'type'        => 'group',
		'repeatable'  => false,
		'options'     => array(
			'group_title'    => esc_html__( 'Тип размещения', 'cmb2' ),
			'closed'         => true
		),
	) );

	$alloptions_glamping_options->add_group_field( $glamping_allocation_group, array(
		'name' => esc_html__( 'Название', 'glamping-club' ),
		// 'desc' => esc_html__( 'Название  Типа места', 'glamping-club' ),
		'id'   => 'title',
		'type' => 'text',
        'repeatable'  => true,
	) );

    $glamping_facilities_general_group = $alloptions_glamping_options->add_field( array(
		'id'          => 'glamping_facilities_general',
		'type'        => 'group',
		'repeatable'  => false,
		'options'     => array(
			'group_title'    => esc_html__( 'Удобства общие', 'cmb2' ),
			'closed'         => true
		),
	) );

	$alloptions_glamping_options->add_group_field( $glamping_facilities_general_group, array(
		'name' => esc_html__( 'Название', 'glamping-club' ),
		// 'desc' => esc_html__( 'Название  Типа места', 'glamping-club' ),
		'id'   => 'title',
		'type' => 'text',
        'repeatable'  => true,
	) );

    $glamping_facilities_general_kitchen = $alloptions_glamping_options->add_field( array(
		'id'          => 'facilities_general_kitchen',
		'type'        => 'group',
		'repeatable'  => false,
		'options'     => array(
			'group_title'    => esc_html__( 'Кухня', 'cmb2' ),
			'closed'         => true
		),
	) );

	$alloptions_glamping_options->add_group_field( $glamping_facilities_general_kitchen, array(
		'name' => esc_html__( 'Название', 'glamping-club' ),
		// 'desc' => esc_html__( 'Название  Типа места', 'glamping-club' ),
		'id'   => 'title',
		'type' => 'text',
        'repeatable'  => true,
	) );

    $glamping_facilities_general_bathroom = $alloptions_glamping_options->add_field( array(
		'id'          => 'facilities_general_bathroom',
		'type'        => 'group',
		'repeatable'  => false,
		'options'     => array(
			'group_title'    => esc_html__( 'Ванная комната', 'cmb2' ),
			'closed'         => true
		),
	) );

	$alloptions_glamping_options->add_group_field( $glamping_facilities_general_bathroom, array(
		'name' => esc_html__( 'Название', 'glamping-club' ),
		// 'desc' => esc_html__( 'Название  Типа места', 'glamping-club' ),
		'id'   => 'title',
		'type' => 'text',
        'repeatable'  => true,
	) );



    $glamping_nutrition_group = $alloptions_glamping_options->add_field( array(
		'id'          => 'glamping_nutrition',
		'type'        => 'group',
		'repeatable'  => false,
		'options'     => array(
			'group_title'    => esc_html__( 'Питание', 'cmb2' ),
			'closed'         => true
		),
	) );

	$alloptions_glamping_options->add_group_field( $glamping_nutrition_group, array(
		'name' => esc_html__( 'Название', 'glamping-club' ),
		// 'desc' => esc_html__( 'Название  Типа места', 'glamping-club' ),
		'id'   => 'title',
		'type' => 'text',
        'repeatable'  => true,
	) );

    $facilities_options_children_group = $alloptions_glamping_options->add_field( array(
		'id'          => 'facilities_options_children',
		'type'        => 'group',
		'repeatable'  => false,
		'options'     => array(
			'group_title'    => esc_html__( 'Для детей', 'cmb2' ),
			'closed'         => true
		),
	) );

	$alloptions_glamping_options->add_group_field( $facilities_options_children_group, array(
		'name' => esc_html__( 'Название', 'glamping-club' ),
		// 'desc' => esc_html__( 'Название  Типа места', 'glamping-club' ),
		'id'   => 'title',
		'type' => 'text',
        'repeatable'  => true,
	) );

    $glamping_territory_group = $alloptions_glamping_options->add_field( array(
		'id'          => 'glamping_territory',
		'type'        => 'group',
		'repeatable'  => false,
		'options'     => array(
			'group_title'    => esc_html__( 'Территория', 'cmb2' ),
			'closed'         => true
		),
	) );

	$alloptions_glamping_options->add_group_field( $glamping_territory_group, array(
		'name' => esc_html__( 'Название', 'glamping-club' ),
		// 'desc' => esc_html__( 'Название  Типа места', 'glamping-club' ),
		'id'   => 'title',
		'type' => 'text',
        'repeatable'  => true,
	) );

    $facilities_options_safety_group = $alloptions_glamping_options->add_field( array(
		'id'          => 'facilities_options_safety',
		'type'        => 'group',
		'repeatable'  => false,
		'options'     => array(
			'group_title'    => esc_html__( 'Безопасность', 'cmb2' ),
			'closed'         => true
		),
	) );

	$alloptions_glamping_options->add_group_field( $facilities_options_safety_group, array(
		'name' => esc_html__( 'Название', 'glamping-club' ),
		// 'desc' => esc_html__( 'Название  Типа места', 'glamping-club' ),
		'id'   => 'title',
		'type' => 'text',
        'repeatable'  => true,
	) );

    $glamping_entertainment_group = $alloptions_glamping_options->add_field( array(
		'id'          => 'glamping_entertainment',
		'type'        => 'group',
		'repeatable'  => false,
		'options'     => array(
			'group_title'    => esc_html__( 'Развлечения', 'cmb2' ),
			'closed'         => true
		),
	) );

	$alloptions_glamping_options->add_group_field( $glamping_entertainment_group, array(
		'name' => esc_html__( 'Название', 'glamping-club' ),
		// 'desc' => esc_html__( 'Название  Типа места', 'glamping-club' ),
		'id'   => 'title',
		'type' => 'text',
        'repeatable'  => true,
	) );

    $glamping_nature_around_group = $alloptions_glamping_options->add_field( array(
		'id'          => 'glamping_nature_around',
		'type'        => 'group',
		'repeatable'  => false,
		'options'     => array(
			'group_title'    => esc_html__( 'Природа вокруг', 'cmb2' ),
			'closed'         => true
		),
	) );

	$alloptions_glamping_options->add_group_field( $glamping_nature_around_group, array(
		'name' => esc_html__( 'Название', 'glamping-club' ),
		// 'desc' => esc_html__( 'Название  Типа места', 'glamping-club' ),
		'id'   => 'title',
		'type' => 'text',
        'repeatable'  => true,
	) );

    $facilities_options_home_group = $alloptions_glamping_options->add_field( array(
		'id'          => 'facilities_options_home',
		'type'        => 'group',
		'repeatable'  => false,
		'options'     => array(
			'group_title'    => esc_html__( 'Удобства в доме (варианты размещений)', 'cmb2' ),
			'closed'         => true
		),
	) );

	$alloptions_glamping_options->add_group_field( $facilities_options_home_group, array(
		'name' => esc_html__( 'Название', 'glamping-club' ),
		// 'desc' => esc_html__( 'Название  Типа места', 'glamping-club' ),
		'id'   => 'title',
		'type' => 'text',
        'repeatable'  => true,
	) );

    $facilities_options_bathroom_group = $alloptions_glamping_options->add_field( array(
		'id'          => 'facilities_options_bathroom',
		'type'        => 'group',
		'repeatable'  => false,
		'options'     => array(
			'group_title'    => esc_html__( 'Удобства в ванной комнате (варианты размещений)', 'cmb2' ),
			'closed'         => true
		),
	) );

	$alloptions_glamping_options->add_group_field( $facilities_options_bathroom_group, array(
		'name' => esc_html__( 'Название', 'glamping-club' ),
		// 'desc' => esc_html__( 'Название  Типа места', 'glamping-club' ),
		'id'   => 'title',
		'type' => 'text',
        'repeatable'  => true,
	) );

    $facilities_options_kitchen_group = $alloptions_glamping_options->add_field( array(
		'id'          => 'facilities_options_kitchen',
		'type'        => 'group',
		'repeatable'  => false,
		'options'     => array(
			'group_title'    => esc_html__( 'Удобства на кухне (варианты размещений)', 'cmb2' ),
			'closed'         => true
		),
	) );

	$alloptions_glamping_options->add_group_field( $facilities_options_kitchen_group, array(
		'name' => esc_html__( 'Название', 'glamping-club' ),
		// 'desc' => esc_html__( 'Название  Типа места', 'glamping-club' ),
		'id'   => 'title',
		'type' => 'text',
        'repeatable'  => true,
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
