<?php
add_action( 'cmb2_init', 'register_single_glampings_metabox' );
function register_single_glampings_metabox() {
	$single_glampings = new_cmb2_box( array(
		'id'           => 'single_glampings',
		'title'        => esc_html__( 'Характеристики глэмпинга', 'glamping-club' ),
		'object_types' => array( 'glampings' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
        'classes'      => 'flex-box',
		'show_in_rest' => true
	) );

	$single_glampings->add_field( array(
		'name' => esc_html__( 'Рекомендован', 'glamping-club' ),
		'id'   => 'glamping_recommended',
		'type'    => 'radio_inline',
		'options' => array(
			'no' => 'Нет',
        	'yes' => 'Да'
		),
		'default' => 'no',
		'column' => array(
			'position' => 4,
			'name'     => 'Рекомендован',
		),
		'display_cb' => 'glamping_recommended_display',
	) );

	$single_glampings->add_field( array(
		'name' => __( 'Тип места <span class="required">*</span>', 'glamping-club' ),
		'id'   => 'glamping_type',
		'type'    => 'multicheck_inline',
		'options_cb' => 'type_options',
		// 'options' => array(
		// 	'glamping' => __( 'Глэмпинг', 'glamping-club' ),
		// 	'eco_hotel'   => __( 'Эко-отель', 'glamping-club' ),
		// 	'camp_site'     => __( 'Турбаза', 'glamping-club' ),
		// 	'private_sector'     => __( 'Частный сектор', 'glamping-club' ),
		// ),
		'default' => 'glamping',
		'classes' => ['multicheck-required'],
		'after_field' => 'multicheck_required_warn_text',
	) );

	$single_glampings->add_field( array(
		'name' => __( 'Тип размещения <span class="required">*</span>', 'glamping-club' ),
		'id'   => 'glamping_allocation',
		'type' => 'multicheck_inline',
		'classes' => ['multicheck-required'],
		'options_cb' => 'allocation_options',
		'after_field' => 'multicheck_required_warn_text',
	) );

    $single_glampings->add_field( array(
		'name' => esc_html__( 'Количество домиков', 'glamping-club' ),
		'id'   => 'glamping_number_houses',
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'min'  => '1',
			// 'required'    => 'required'
		),
	) );

	// $single_glampings->add_field( array(
	// 	'name' => esc_html__( 'Вместимость', 'glamping-club' ),
	// 	'id'   => 'glamping_capacity',
	// 	'type' => 'text',
	// 	'attributes' => array(
	// 		'type' => 'number',
	// 		'min'  => '1',
	// 		'required'    => 'required'
	// 	),
	// ) );

	$single_glampings->add_field( array(
		'name' => esc_html__( 'Стоимость', 'glamping-club' ),
		'id'   => 'glamping_price',
		'type' => 'text',
		'before_field' => '₽',
		'attributes' => array(
			'type' => 'number',
			'min'  => '1',
			'required'    => 'required'
		),
	) );

	$single_glampings->add_field( array(
		'name' => esc_html__( 'Режим работы', 'glamping-club' ),
		'id'   => 'working_mode',
		'type'    => 'radio_inline',
		'options' => array(
			'whole_year' => __( 'Весь год', 'glamping-club' ),
            'seasonal'   => __( 'Сезонный', 'glamping-club' ),
		),
		'default' => 'whole_year',
		'classes' => ['conditional-parent'],
		'attributes'  => array(
			'data-child' => 'working_mode_seasons',
		),
	) );

	$single_glampings->add_field( array(
		'name' => esc_html__( 'Режим работы - сезоны', 'glamping-club' ),
		'id'   => 'working_mode_seasons',
		'type' => 'multicheck_inline',
		'options_cb' => 'working_mode_seasons',
		'classes' => ['conditional-child', 'seasonal', 'working_mode_seasons'],
	) );

	$single_glampings->add_field( array(
		'name' => esc_html__( 'Удобства общие', 'glamping-club' ),
		'id'   => 'glamping_facilities_general',
		'type' => 'multicheck_inline',
		'options_cb' => 'facilities_options_general',
	) );

	$single_glampings->add_field( array(
		'name' => esc_html__( 'Кухня', 'glamping-club' ),
		'id'   => 'facilities_general_kitchen',
		'type' => 'multicheck_inline',
		'options_cb' => 'facilities_general_kitchen',
	) );

	$single_glampings->add_field( array(
		'name' => esc_html__( 'Ванная комната', 'glamping-club' ),
		'id'   => 'facilities_general_bathroom',
		'type' => 'multicheck_inline',
		'options_cb' => 'facilities_general_bathroom',
	) );

	// $single_glampings->add_field( array(
	// 	'name' => esc_html__( 'Удобства в доме', 'glamping-club' ),
	// 	'id'   => 'facilities_options_home',
	// 	'type' => 'multicheck_inline',
	// 	'options_cb' => 'facilities_options_home',
	// ) );
	//
	// $single_glampings->add_field( array(
	// 	'name' => esc_html__( 'Удобства в ванной комнате', 'glamping-club' ),
	// 	'id'   => 'facilities_options_bathroom',
	// 	'type' => 'multicheck_inline',
	// 	'options_cb' => 'facilities_options_bathroom',
	// ) );
	//
	// $single_glampings->add_field( array(
	// 	'name' => esc_html__( 'Удобства на кухне', 'glamping-club' ),
	// 	'id'   => 'facilities_options_kitchen',
	// 	'type' => 'multicheck_inline',
	// 	'options_cb' => 'facilities_options_kitchen',
	// ) );

	$single_glampings->add_field( array(
		'name' => esc_html__( 'Питание', 'glamping-club' ),
		'id'   => 'glamping_nutrition',
		'type' => 'multicheck_inline',
		'options_cb' => 'nutrition_options',
	) );

	$single_glampings->add_field( array(
		'name' => esc_html__( 'Для детей', 'glamping-club' ),
		'id'   => 'facilities_options_children',
		'type' => 'multicheck_inline',
		'options_cb' => 'facilities_options_children',
	) );

	$single_glampings->add_field( array(
		'name' => esc_html__( 'Территория', 'glamping-club' ),
		'id'   => 'glamping_territory',
		'type' => 'multicheck_inline',
		'options_cb' => 'territory_options',
	) );

	$single_glampings->add_field( array(
		'name' => esc_html__( 'Безопасность', 'glamping-club' ),
		'id'   => 'facilities_options_safety',
		'type' => 'multicheck_inline',
		'options_cb' => 'facilities_options_safety',
	) );

	$single_glampings->add_field( array(
		'name' => esc_html__( 'Развлечения', 'glamping-club' ),
		'id'   => 'glamping_entertainment',
		'type' => 'multicheck_inline',
		'options_cb' => 'entertainment_options',
	) );

	$single_glampings->add_field( array(
		'name' => esc_html__( 'Природа вокруг', 'glamping-club' ),
		'id'   => 'glamping_nature_around',
		'type'    => 'multicheck_inline',
		'options_cb' => 'nature_around_options',
		'options' => array(
			'Лес' => 'Лес',
			'Горы' => 'Горы',
			'Река' => 'Река',
			'Озеро' => 'Озеро',
			'Море' => 'Море',
			'Поле' => 'Поле',
		),
	) );

	$single_glampings->add_field( array(
		'name' => esc_html__( 'Бронирование онлайн', 'glamping-club' ),
		'id'   => 'book_online',
		'type'    => 'radio_inline',
		'options' => array(
			'no' => __( 'Нет', 'glamping-club' ),
			'yes'   => __( 'Есть', 'glamping-club' )
		),
		'default' => 'no',
	) );

	// Дополнительно
	$group_field = $single_glampings->add_field( array(
		'id'          => 'additionally_field',
		'type'        => 'group',
		// 'description' => esc_html__( 'Группа полей', 'glamping-club' ),
		'repeatable'  => false,
		'options'     => array(
			'group_title'    => esc_html__( 'Дополнительно', 'cmb2' ),
			'closed'         => true
		),
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => esc_html__( 'Адрес', 'glamping-club' ),
		// 'desc' => esc_html__( 'Год постройки глэмпинга', 'glamping-club' ),
		'id'   => 'address',
		'type' => 'text',
		'attributes' => array(
			'data-validation' => 'required',
			// 'required' => 'required'
		),
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => esc_html__( 'Координаты', 'glamping-club' ),
		'desc' => esc_html__( 'Координаты через запятую, например: 40.346544,-101.645507', 'glamping-club' ),
		'id'   => 'coordinates',
		'type' => 'text',
		'attributes' => array(
			'data-validation' => 'required',
			// 'required' => 'required'
		),
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => esc_html__( 'Год постройки', 'glamping-club' ),
		// 'desc' => esc_html__( 'Год постройки глэмпинга', 'glamping-club' ),
		'id'   => 'year_construction',
		'type' => 'text',
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => esc_html__( 'Официальный сайт', 'glamping-club' ),
		// 'desc' => esc_html__( 'сайт для бронирования глэмпинга', 'glamping-club' ),
		'id'   => 'site_glamping_ofic',
		'type' => 'text_url',
		'protocols' => array( 'http', 'https' ),
		'attributes' => array(
			'data-validation' => 'required',
			// 'required'    => 'required'
		),
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => esc_html__( 'Сайт для бронирования', 'glamping-club' ),
		// 'desc' => esc_html__( 'сайт для бронирования глэмпинга', 'glamping-club' ),
		'id'   => 'site_glamping',
		'type' => 'text_url',
		'protocols' => array( 'http', 'https' ),
		'attributes' => array(
			'data-validation' => 'required',
			// 'required'    => 'required'
		),
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => esc_html__( 'Телефон', 'glamping-club' ),
		// 'desc' => esc_html__( 'сайт для бронирования глэмпинга', 'glamping-club' ),
		'id'   => 'phone_glamping',
		'type' => 'text',
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => esc_html__( 'Whatsup', 'glamping-club' ),
		// 'desc' => esc_html__( 'сайт для бронирования глэмпинга', 'glamping-club' ),
		'id'   => 'whatsup_glamping',
		'type' => 'text',
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => esc_html__( 'Viber', 'glamping-club' ),
		// 'desc' => esc_html__( 'сайт для бронирования глэмпинга', 'glamping-club' ),
		'id'   => 'viber_glamping',
		'type' => 'text',
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => esc_html__( 'Telegram', 'glamping-club' ),
		// 'desc' => esc_html__( 'сайт для бронирования глэмпинга', 'glamping-club' ),
		'id'   => 'telegram_glamping',
		'type' => 'text',
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => esc_html__( 'E-mail', 'glamping-club' ),
		// 'desc' => esc_html__( 'сайт для бронирования глэмпинга', 'glamping-club' ),
		'id'   => 'email_glamping',
		'type' => 'text',
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => esc_html__( 'Минимальное количество ночей для бронирования', 'glamping-club' ),
		// 'desc' => esc_html__( 'сайт для бронирования глэмпинга', 'glamping-club' ),
		'id'   => 'min_nights_booking',
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'min'  => '1',
		),
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => esc_html__( 'Заезд:', 'glamping-club' ),
		'desc' => esc_html__( 'после указанного времени', 'glamping-club' ),
		'id'   => 'checkin_glamping',
		'type' => 'text_time',
		'attributes' => array(
			'data-timepicker' => json_encode( array(
				// 'timeOnlyTitle' => __( 'Choose your Time', 'cmb2' ),
				'timeFormat' => 'H:mm',
				'stepMinute' => 10, // 1 minute increments instead of the default 5
			) ),
			'data-validation' => 'required',
			// 'required'    => 'required'
		),
		'time_format' => 'H:i'
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => esc_html__( 'Выезд:', 'glamping-club' ),
		'desc' => esc_html__( 'до указанного времени', 'glamping-club' ),
		'id'   => 'checkout_glamping',
		'type' => 'text_time',
		'attributes' => array(
			'data-timepicker' => json_encode( array(
				// 'timeOnlyTitle' => __( 'Choose your Time', 'cmb2' ),
				'timeFormat' => 'H:mm',
				'stepMinute' => 10, // 1 minute increments instead of the default 5
			) ),
			'data-validation' => 'required',
			// 'required'    => 'required'
		),
		'time_format' => 'H:i'
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => esc_html__( 'Предоплата:', 'glamping-club' ),
		// 'desc' => esc_html__( 'сайт для бронирования глэмпинга', 'glamping-club' ),
		'id'   => 'prepayment',
		'type' => 'text',
		// 'attributes' => array(
		// 	'type' => 'number',
		// 	'min'  => '1',
		// ),
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => esc_html__( 'Отмена бронирования:', 'glamping-club' ),
		'desc' => esc_html__( 'например: за 7 дней - 100% возврат', 'glamping-club' ),
		'id'   => 'cancel_reservation',
		'type' => 'textarea_small',
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => esc_html__( 'Примечания', 'glamping-club' ),
		// 'desc' => esc_html__( 'например: за 7 дней - 100% возврат', 'glamping-club' ),
		'id'   => 'glc_notes',
		'type' => 'wysiwyg',
	) );

	// Скидка
	$group_field_discount = $single_glampings->add_field( array(
		'id'          => 'discount',
		'type'        => 'group',
		// 'description' => esc_html__( 'Группа полей', 'glamping-club' ),
		'repeatable'  => false,
		'options'     => array(
			'group_title'    => esc_html__( 'Скидка', 'cmb2' ),
			'closed'         => true
		),
	) );

	$single_glampings->add_group_field( $group_field_discount, array(
		'name' => esc_html__( 'Промокод', 'glamping-club' ),
		'id'   => 'promo_code',
		'type' => 'text',
	) );

	$single_glampings->add_group_field( $group_field_discount, array(
		'name' => esc_html__( 'Скидка', 'glamping-club' ),
		'id'   => 'discount',
		'type' => 'text',
	) );

	$single_glampings->add_group_field( $group_field_discount, array(
		'name' => esc_html__( 'Описание скидки', 'glamping-club' ),
		'id'   => 'discount_text',
		'type' => 'textarea',
	) );

	// Фото
	$media_gallery = new_cmb2_box( array(
		'id'           => 'media_gallery',
		'title'        => esc_html__( 'Фото', 'glamping-club' ),
		'object_types' => array( 'glampings' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
        'classes'      => 'flex-box',
		'show_in_rest' => true
	) );

	$media_gallery->add_field( array(
		'name' => esc_html__( 'Фото', 'glamping-club' ),
		// 'desc' => esc_html__( 'Год постройки глэмпинга', 'glamping-club' ),
		'id'   => 'media_gallery',
		'type' => 'file_list',
		'preview_size' => array( 100, 100 ),
		'options' => array(
			'url' => false, // Hide the text input for the url
		),
	) );

	// Варианты размещения
	$accommodation_options = new_cmb2_box( array(
		'id'           => 'accommodation_options',
		'title'        => esc_html__( 'Варианты размещения', 'glamping-club' ),
		'object_types' => array( 'glampings' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
        'classes'      => 'flex-box',
		'show_in_rest' => true
	) );

	$acc_options_group = $accommodation_options->add_field( array(
		'id'          => 'acc_options',
		'type'        => 'group',
		// 'description' => esc_html__( 'Группа полей', 'glamping-club' ),
		// 'repeatable'  => false,
		'options'     => array(
			'group_title'    => esc_html__( 'Вариант размещения', 'cmb2' ),
			'add_button'     => __( 'Добавить вариант размещения', 'cmb2' ),
			'remove_button'  => __( 'Удалить вариант размещения', 'cmb2' ),
			'sortable'       => true,
			'closed'         => true
		),
	) );

	$accommodation_options->add_group_field( $acc_options_group, array(
		'name' => esc_html__( 'Название варианта размещения', 'glamping-club' ),
		// 'desc' => esc_html__( 'Год постройки глэмпинга', 'glamping-club' ),
		'id'   => 'title',
		'type' => 'text',
	) );

	$accommodation_options->add_group_field( $acc_options_group, array(
		'name' => esc_html__( 'Описание варианта размещения', 'glamping-club' ),
		// 'desc' => esc_html__( 'Год постройки глэмпинга', 'glamping-club' ),
		'id'   => 'description',
		'type' => 'wysiwyg',
	) );

	$accommodation_options->add_group_field( $acc_options_group, array(
		'name' => esc_html__( 'Площадь (кв.м)', 'glamping-club' ),
		// 'desc' => esc_html__( 'Год постройки глэмпинга', 'glamping-club' ),
		'id'   => 'area',
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'min'  => '0.1',
			'step' => '0.1',
		),
	) );

	$accommodation_options->add_group_field( $acc_options_group, array(
		'name' => esc_html__( 'Мест', 'glamping-club' ),
		// 'desc' => esc_html__( 'Год постройки глэмпинга', 'glamping-club' ),
		'id'   => 'places',
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'min'  => '1',
		),
	) );

	$accommodation_options->add_group_field( $acc_options_group, array(
		'name' => esc_html__( 'Стоимость (руб)', 'glamping-club' ),
		// 'desc' => esc_html__( 'Год постройки глэмпинга', 'glamping-club' ),
		'id'   => 'price',
		'type' => 'text',
		'before_field' => '₽',
		'attributes' => array(
			'type' => 'number',
			'min'  => '1',
		),
	) );

	$accommodation_options->add_group_field( $acc_options_group, array(
		'name' => esc_html__( 'Удобства в доме', 'glamping-club' ),
		'id'   => 'facilities_options_home',
		'type' => 'multicheck_inline',
		'options_cb' => 'facilities_options_home',
	) );

	$accommodation_options->add_group_field( $acc_options_group, array(
		'name' => esc_html__( 'Удобства в ванной комнате', 'glamping-club' ),
		'id'   => 'facilities_options_bathroom',
		'type' => 'multicheck_inline',
		'options_cb' => 'facilities_options_bathroom',
	) );

	$accommodation_options->add_group_field( $acc_options_group, array(
		'name' => esc_html__( 'Удобства на кухне', 'glamping-club' ),
		'id'   => 'facilities_options_kitchen',
		'type' => 'multicheck_inline',
		'options_cb' => 'facilities_options_kitchen',
	) );

	$accommodation_options->add_group_field( $acc_options_group, array(
		'name' => esc_html__( 'Фото', 'glamping-club' ),
		// 'desc' => esc_html__( 'Год постройки глэмпинга', 'glamping-club' ),
		'id'   => 'media_gallery',
		'type' => 'file_list',
		'preview_size' => array( 100, 100 ),
	) );

	// Часто задаваемые вопросы
	$faq_options = new_cmb2_box( array(
		'id'           => 'faq_options',
		'title'        => esc_html__( 'Часто задаваемые вопросы', 'glamping-club' ),
		'object_types' => array( 'glampings' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
        'classes'      => 'flex-box',
		'show_in_rest' => true
	) );

	$faq_options_group = $faq_options->add_field( array(
		'id'          => 'faq_options',
		'type'        => 'group',
		// 'description' => esc_html__( 'Группа полей', 'glamping-club' ),
		// 'repeatable'  => false,
		'options'     => array(
			'group_title'    => esc_html__( 'Вопрос', 'cmb2' ),
			'add_button'     => __( 'Добавить вопрос', 'cmb2' ),
			'remove_button'  => __( 'Удалить вопрос', 'cmb2' ),
			'sortable'       => true,
			'closed'         => true
		),
	) );

	$faq_options->add_group_field( $faq_options_group, array(
		'name' => esc_html__( 'Текст вопроса', 'glamping-club' ),
		// 'desc' => esc_html__( 'Год постройки глэмпинга', 'glamping-club' ),
		'id'   => 'title',
		'type' => 'text',
	) );

	$faq_options->add_group_field( $faq_options_group, array(
		'name' => esc_html__( 'Текст ответа', 'glamping-club' ),
		// 'desc' => esc_html__( 'Год постройки глэмпинга', 'glamping-club' ),
		'id'   => 'text',
		'type' => 'textarea_small',
	) );

	// Чем заняться
	$what_to_do = new_cmb2_box( array(
		'id'           => 'wtd_options',
		'title'        => esc_html__( 'Чем заняться', 'glamping-club' ),
		'object_types' => array( 'glampings' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'classes'      => 'flex-box',
		'show_in_rest' => true
	) );

	$wtd_options_group = $what_to_do->add_field( array(
		'id'          => 'wtd_options',
		'type'        => 'group',
		'options'     => array(
			'group_title'    => esc_html__( 'Вариант чем заняться', 'cmb2' ),
			'add_button'     => __( 'Добавить вариант', 'cmb2' ),
			'remove_button'  => __( 'Удалить вариант', 'cmb2' ),
			'sortable'       => true,
			'closed'         => true
		),
	) );

	$what_to_do->add_group_field( $wtd_options_group, array(
		'name' => esc_html__( 'Заголовок', 'glamping-club' ),
		'id'   => 'title',
		'type' => 'text',
	) );

	$what_to_do->add_group_field( $wtd_options_group, array(
		'name' => esc_html__( 'Описание', 'glamping-club' ),
		// 'desc' => esc_html__( 'Год постройки глэмпинга', 'glamping-club' ),
		'id'   => 'type_price',
		'type'    => 'radio_inline',
		'options' => array(
			'Бесплатно' => __( 'Бесплатно', 'glamping-club' ),
			'Оплачивается отдельно'   => __( 'Оплачивается отдельно', 'glamping-club' ),
		),
		'default' => 'Бесплатно',
	) );

	$what_to_do->add_group_field( $wtd_options_group, array(
		'name' => esc_html__( 'Описание', 'glamping-club' ),
		// 'desc' => esc_html__( 'Год постройки глэмпинга', 'glamping-club' ),
		'id'   => 'text',
		'type' => 'textarea_small',
	) );

	$what_to_do->add_group_field( $wtd_options_group, array(
		'name' => esc_html__( 'Фото', 'glamping-club' ),
		// 'desc' => esc_html__( 'Фото', 'glamping-club' ),
		'id'   => 'wtd_img',
		'type' => 'file',
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
		'preview_size' => array( 220, 220 ),
        'classes' => 'glc-form-group glc-form-group-thumbnail',
		// 'query_args' => array(
		// 	'author' => get_current_user_id()
		// ),
	) );

}

function glamping_recommended_display( $field_args, $field ) {
	$chec_value = '';
	if ($field->escaped_value() == 'yes') {
		$chec_value = ' checked';
	}
	echo '<input type="checkbox" class="cmb2-option-cust glamping_recommended_list" name="glamping_recommended_list" id="glamping_recommended_list-' . $field->object_id . '" data-glamp="' . $field->object_id . '" ' . $chec_value . '>
	<label for="glamping_recommended_list-' . $field->object_id . '">Рекомендовать</label>';
}

function multicheck_required_warn_text() {
	return '<div class="required-warning"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
	<path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464zM256 304c13.25 0 24-10.75 24-24v-128C280 138.8 269.3 128 256 128S232 138.8 232 152v128C232 293.3 242.8 304 256 304zM256 337.1c-17.36 0-31.44 14.08-31.44 31.44C224.6 385.9 238.6 400 256 400s31.44-14.08 31.44-31.44C287.4 351.2 273.4 337.1 256 337.1z"/>
	</svg><span>Выберите один или несколько вариантов</span></div>';
}

// function hook_in_and_add_default_group_value( $post_id, $updated, $cmb ) {
// 	if ( in_array( 'working_mode', $updated ) ) {
// 		if ( 'whole_year' === get_post_meta( $post_id, 'working_mode', 1 ) ) {
// 			// do stuff
// 			update_post_meta( $post_id, 'working_mode_seasons',
// 				array('январь','февраль','март','апрель','май','июнь','июль','август','сентябрь','октябрь','ноябрь','декабрь')
// 			);
// 		}
// 	}
// }
// add_action( 'cmb2_save_post_fields_single_glampings', 'hook_in_and_add_default_group_value', 10, 3 );
