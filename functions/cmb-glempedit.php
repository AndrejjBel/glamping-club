<?php
if ( !is_admin() ) {
	add_action( 'cmb2_init', 'register_single_glampings_metabox_front' );
}

function register_single_glampings_metabox_front() {
	$single_glampings = new_cmb2_box( array(
		'id'           => 'single_glampings_front',
		'title'        => esc_html__( 'Характеристики глэмпинга', 'glamping-club' ),
		'object_types' => array( 'glampings' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
        'classes'      => 'glc-flex-box',
        'hookup' => false,
        'save_fields' => false
	) );

    $single_glampings->add_field( array(
		'name' => __( 'Заголовок <span class="required">*</span>', 'glamping-club' ),
		'id'   => 'glamping_title',
		'type' => 'text',
        'classes' => 'glc-form-group',
        'default_cb' => 'set_to_post_title',
        'attributes'  => array(
            'required'    => 'required',
			'data-valid' => 'required-field'
        )
	) );

    $single_glampings->add_field( array(
        'name' => __( 'Регион <span class="required">*</span>' , 'glamping-club' ),
        'id' => 'glamping_location',
        'type' => 'select',
        'classes' => 'glc-form-group-select',
        'default_cb' => 'set_to_glamping_location_options',
        'options_cb' => 'get_glamping_location_options'
    ) );

    $single_glampings->add_field( array(
		'name' => __( 'Описание глэмпинга <span class="required">*</span>', 'glamping-club' ),
		// 'desc' => esc_html__( 'Год постройки глэмпинга', 'glamping-club' ),
		'id'   => 'glamping_description',
		'type' => 'wysiwyg',
        'classes' => 'glc-form-group',
        'default_cb' => 'set_to_post_content',
        'options' => array(
            'wpautop' => true, // use wpautop?
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_name' => 'glamping_description', // set the textarea name to something different, square brackets [] can be used here
            'textarea_rows' => 6, // rows="..."
            // 'tabindex' => '',
            // 'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the `<style>` tags, can use "scoped".
            // 'editor_class' => '', // add extra class(es) to the editor textarea
            // 'teeny' => false, // output the minimal editor config used in Press This
            // 'dfw' => false, // replace the default fullscreen with DFW (needs specific css)
            // 'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
            'quicktags' => false // load Quicktags, can be used to pass settings directly to Quicktags using an array()
        ),
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
	) );

	$single_glampings->add_field( array(
		'name' => __( 'Тип размещения <span class="required">*</span>', 'glamping-club' ),
		'id'   => 'glamping_allocation',
		'type' => 'multicheck_inline',
		'options_cb' => 'allocation_options',
	) );

    $single_glampings->add_field( array(
		'name' => __( 'Количество домиков <span class="required">*</span>', 'glamping-club' ),
		'id'   => 'glamping_number_houses',
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'min'  => '1',
		),
        'classes' => 'glc-form-group glc-form-group-number'
	) );

	// $single_glampings->add_field( array(
	// 	'name' => esc_html__( 'Вместимость', 'glamping-club' ),
	// 	'id'   => 'glamping_capacity',
	// 	'type' => 'text',
	// 	'attributes' => array(
	// 		'type' => 'number',
	// 		'min'  => '1',
	// 	),
    //     'classes' => 'glc-form-group'
	// ) );

	$single_glampings->add_field( array(
		'name' => __( 'Стоимость <span class="required">*</span>', 'glamping-club' ),
		'id'   => 'glamping_price',
		'type' => 'text',
		'before_field' => '₽',
		'attributes' => array(
			'type' => 'number',
			'min'  => '1',
		),
        'classes' => 'glc-form-group glc-form-group-price'
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

    // $single_glampings->add_field( array(
	// 	'name' => esc_html__( 'Фото', 'glamping-club' ),
	// 	'desc' => esc_html__( 'Основная картинка', 'glamping-club' ),
	// 	'id'   => 'glamping_thumbnail',
	// 	'type' => 'file',
    //     'options' => array(
    //         'url' => false, // Hide the text input for the url
    //     ),
	// 	'preview_size' => array( 220, 220 ),
    //     'classes' => 'glc-form-group glc-form-group-thumbnail'
	// ) );

	// $single_glampings->add_field( array(
	// 	'name' => esc_html__( 'Бронирование онлайн', 'glamping-club' ),
	// 	'id'   => 'book_online',
	// 	'type'    => 'radio_inline',
	// 	'options' => array(
	// 		'no' => __( 'Нет', 'glamping-club' ),
	// 		'yes'   => __( 'Есть', 'glamping-club' )
	// 	),
	// 	'default' => 'no',
	// ) );

	// Дополнительно
	$group_field = $single_glampings->add_field( array(
		'id'          => 'additionally_field',
		'type'        => 'group',
		// 'description' => esc_html__( 'Группа полей', 'glamping-club' ),
		'repeatable'  => false,
		'options'     => array(
			'group_title'    => __( 'Дополнительно <span class="required">(есть обязательные поля)</span>', 'cmb2' ),
			'closed'         => true
		),
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => __( 'Адрес <span class="required">*</span>', 'glamping-club' ),
		// 'desc' => esc_html__( 'Год постройки глэмпинга', 'glamping-club' ),
		'id'   => 'address',
		'type' => 'text',
        'classes' => 'glc-form-group',
		'attributes' => array(
            'data-valid' => 'required-field'
		),
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => __( 'Координаты <span class="required">*</span>', 'glamping-club' ),
		'desc' => esc_html__( 'Координаты через запятую, например: 40.346544,-101.645507', 'glamping-club' ),
		'id'   => 'coordinates',
		'type' => 'text',
        'classes' => 'glc-form-group',
		'attributes' => array(
            'data-valid' => 'required-field'
		),
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => __( 'Сайт для бронирования <span class="required">*</span>', 'glamping-club' ),
		// 'desc' => esc_html__( 'сайт для бронирования глэмпинга', 'glamping-club' ),
		'id'   => 'site_glamping',
		'type' => 'text_url',
		'protocols' => array( 'http', 'https' ),
        'classes' => 'glc-form-group',
		'attributes' => array(
            'data-valid' => 'required-field'
		),
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => __( 'Официальный сайт', 'glamping-club' ),
		// 'desc' => esc_html__( 'сайт для бронирования глэмпинга', 'glamping-club' ),
		'id'   => 'site_glamping_ofic',
		'type' => 'text_url',
		'protocols' => array( 'http', 'https' ),
		'classes' => 'glc-form-group',
		// 'attributes' => array(
		// 	'data-validation' => 'required'
		// ),
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => __( 'Заезд: <span class="required">*</span>', 'glamping-club' ),
		'desc' => esc_html__( 'после указанного времени', 'glamping-club' ),
		'id'   => 'checkin_glamping',
		'type' => 'text_time',
		'attributes' => array(
			'data-timepicker' => json_encode( array(
				// 'timeOnlyTitle' => __( 'Choose your Time', 'cmb2' ),
				'timeFormat' => 'H:mm',
				'stepMinute' => 10, // 1 minute increments instead of the default 5
			) ),
			'data-valid' => 'required-field'
		),
		'time_format' => 'H:i',
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => __( 'Выезд: <span class="required">*</span>', 'glamping-club' ),
		'desc' => esc_html__( 'до указанного времени', 'glamping-club' ),
		'id'   => 'checkout_glamping',
		'type' => 'text_time',
		'attributes' => array(
			'data-timepicker' => json_encode( array(
				// 'timeOnlyTitle' => __( 'Choose your Time', 'cmb2' ),
				'timeFormat' => 'H:mm',
				'stepMinute' => 10, // 1 minute increments instead of the default 5
			) ),
			'data-valid' => 'required-field'
		),
		'time_format' => 'H:i',
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => esc_html__( 'Год постройки', 'glamping-club' ),
		// 'desc' => esc_html__( 'Год постройки глэмпинга', 'glamping-club' ),
		'id'   => 'year_construction',
		'type' => 'text',
        'classes' => 'glc-form-group glc-form-group-number'
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => esc_html__( 'Телефон', 'glamping-club' ),
		// 'desc' => esc_html__( 'сайт для бронирования глэмпинга', 'glamping-club' ),
		'id'   => 'phone_glamping',
		'type' => 'text',
        'classes' => 'glc-form-group glc-form-group-number'
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => esc_html__( 'Whatsup', 'glamping-club' ),
		// 'desc' => esc_html__( 'сайт для бронирования глэмпинга', 'glamping-club' ),
		'id'   => 'whatsup_glamping',
		'type' => 'text',
        'classes' => 'glc-form-group glc-form-group-number'
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => esc_html__( 'Viber', 'glamping-club' ),
		// 'desc' => esc_html__( 'сайт для бронирования глэмпинга', 'glamping-club' ),
		'id'   => 'viber_glamping',
		'type' => 'text',
        'classes' => 'glc-form-group glc-form-group-number'
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => esc_html__( 'Telegram', 'glamping-club' ),
		// 'desc' => esc_html__( 'сайт для бронирования глэмпинга', 'glamping-club' ),
		'id'   => 'telegram_glamping',
		'type' => 'text',
        'classes' => 'glc-form-group glc-form-group-number'
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => esc_html__( 'E-mail', 'glamping-club' ),
		// 'desc' => esc_html__( 'сайт для бронирования глэмпинга', 'glamping-club' ),
		'id'   => 'email_glamping',
		'type' => 'text',
        'classes' => 'glc-form-group glc-form-group-number'
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
        'classes' => 'glc-form-group glc-form-group-number'
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => esc_html__( 'Предоплата:', 'glamping-club' ),
		// 'desc' => esc_html__( 'сайт для бронирования глэмпинга', 'glamping-club' ),
		'id'   => 'prepayment',
		'type' => 'text',
        'classes' => 'glc-form-group glc-form-group-number'
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
        'classes' => 'glc-form-group'
	) );

	$single_glampings->add_group_field( $group_field, array(
		'name' => esc_html__( 'Примечания', 'glamping-club' ),
		// 'desc' => esc_html__( 'например: за 7 дней - 100% возврат', 'glamping-club' ),
		'id'   => 'glc_notes',
		'type' => 'wysiwyg',
        'options' => array(
            'wpautop' => true, // use wpautop?
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_name' => 'glc_notes', // set the textarea name to something different, square brackets [] can be used here
            'textarea_rows' => 6, // rows="..."
            // 'tabindex' => '',
            // 'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the `<style>` tags, can use "scoped".
            // 'editor_class' => '', // add extra class(es) to the editor textarea
            // 'teeny' => false, // output the minimal editor config used in Press This
            // 'dfw' => false, // replace the default fullscreen with DFW (needs specific css)
            // 'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
            'quicktags' => false // load Quicktags, can be used to pass settings directly to Quicktags using an array()
        ),
	) );

	// Скидка
	// $group_field_discount = $single_glampings->add_field( array(
	// 	'id'          => 'discount',
	// 	'type'        => 'group',
	// 	// 'description' => esc_html__( 'Группа полей', 'glamping-club' ),
	// 	'repeatable'  => false,
	// 	'options'     => array(
	// 		'group_title'    => esc_html__( 'Скидка', 'cmb2' ),
	// 		'closed'         => true
	// 	),
	// ) );
	//
	// $single_glampings->add_group_field( $group_field_discount, array(
	// 	'name' => esc_html__( 'Промокод', 'glamping-club' ),
	// 	'id'   => 'promo_code',
	// 	'type' => 'text',
    //     'classes' => 'glc-form-group glc-form-group-number'
	// ) );
	//
	// $single_glampings->add_group_field( $group_field_discount, array(
	// 	'name' => esc_html__( 'Скидка', 'glamping-club' ),
	// 	'id'   => 'discount',
	// 	'type' => 'text',
    //     'classes' => 'glc-form-group glc-form-group-number'
	// ) );
	//
	// $single_glampings->add_group_field( $group_field_discount, array(
	// 	'name' => esc_html__( 'Описание скидки', 'glamping-club' ),
	// 	'id'   => 'discount_text',
	// 	'type' => 'textarea',
	// ) );

    $single_glampings->add_field( array(
		'name' => esc_html__( 'Основное фото', 'glamping-club' ),
		'desc' => esc_html__( 'Основное фото глэмпинга', 'glamping-club' ),
		'id'   => 'glamping_thumbnail',
		'type' => 'file',
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
		'preview_size' => array( 220, 220 ),
        'classes' => 'glc-form-group glc-form-group-thumbnail',
        'default_cb' => 'set_to_post_thumbnail',
		'query_args' => array(
			'author' => get_current_user_id()
		),
	) );

	// Фото
	$media_gallery = new_cmb2_box( array(
		'id'           => 'media_gallery_front',
		'title'        => esc_html__( 'Дополнительные фото', 'glamping-club' ),
		'object_types' => array( 'glampings' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
        'classes'      => 'flex-box',
	) );

	$media_gallery->add_field( array(
		'name' => esc_html__( 'Дополнительные фото', 'glamping-club' ),
		'desc' => esc_html__( 'Дополнительные фото глэмпинга', 'glamping-club' ),
		'id'   => 'media_gallery',
		'type' => 'file_list',
		'preview_size' => array( 100, 100 ),
		'options' => array(
			'url' => false, // Hide the text input for the url
		),
		'query_args' => array(
			'author' => get_current_user_id()
		),
	) );

	// Варианты размещения
	$accommodation_options = new_cmb2_box( array(
		'id'           => 'accommodation_options_front',
		'title'        => esc_html__( 'Варианты размещения', 'glamping-club' ),
		'object_types' => array( 'glampings' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
        'classes'      => 'flex-box acc-options',
	) );

	$acc_options_group = $accommodation_options->add_field( array(
		'id'          => 'acc_options',
		'type'        => 'group',
		// 'description' => esc_html__( 'Группа полей', 'glamping-club' ),
		// 'repeatable'  => false,
		'options'     => array(
			'group_title'    => esc_html__( 'Вариант размещения', 'cmb2' ),
			'add_button'     => __( 'Добавить вариант размещения', 'cmb2' ),
			'remove_button'  => __( 'Удалить вариант', 'cmb2' ),
			'sortable'       => true,
			'closed'         => true
		),
	) );

	$accommodation_options->add_group_field( $acc_options_group, array(
		'name' => __( 'Название варианта размещения <span class="required">*</span>', 'glamping-club' ),
		// 'desc' => esc_html__( 'Год постройки глэмпинга', 'glamping-club' ),
		'id'   => 'title',
		'type' => 'text',
        'classes' => 'glc-form-group required-field',
        'attributes' => array(
            'data-valid' => 'required-field',
			'data-name' => 'title'
		),
	) );

	$accommodation_options->add_group_field( $acc_options_group, array(
		'name' => __( 'Описание варианта размещения <span class="required">*</span>', 'glamping-club' ),
		// 'desc' => esc_html__( 'Год постройки глэмпинга', 'glamping-club' ),
		'id'   => 'description',
		'type' => 'wysiwyg',
        'classes' => 'glc-form-group required-field',
        'options' => array(
            'wpautop' => true, // use wpautop?
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_name' => 'acc_glamping_description', // set the textarea name to something different, square brackets [] can be used here
            'textarea_rows' => 6, // rows="..."
            // 'tabindex' => '',
            // 'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the `<style>` tags, can use "scoped".
            // 'editor_class' => '', // add extra class(es) to the editor textarea
            // 'teeny' => false, // output the minimal editor config used in Press This
            // 'dfw' => false, // replace the default fullscreen with DFW (needs specific css)
            // 'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
            'quicktags' => false // load Quicktags, can be used to pass settings directly to Quicktags using an array()
        ),
	) );

	$accommodation_options->add_group_field( $acc_options_group, array(
		'name' => __( 'Площадь (кв.м) <span class="required">*</span>', 'glamping-club' ),
		// 'desc' => esc_html__( 'Год постройки глэмпинга', 'glamping-club' ),
		'id'   => 'area',
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'min'  => '0.1',
			'step' => '0.1',
            'data-valid' => 'required-field',
			'data-name' => 'area'
		),
        'classes' => 'glc-form-group glc-form-group-number'
	) );

	$accommodation_options->add_group_field( $acc_options_group, array(
		'name' => __( 'Мест <span class="required">*</span>', 'glamping-club' ),
		// 'desc' => esc_html__( 'Год постройки глэмпинга', 'glamping-club' ),
		'id'   => 'places',
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'min'  => '1',
            'data-valid' => 'required-field',
			'data-name' => 'places'
		),
        'classes' => 'glc-form-group glc-form-group-number'
	) );

	$accommodation_options->add_group_field( $acc_options_group, array(
		'name' => __( 'Стоимость (руб) <span class="required">*</span>', 'glamping-club' ),
		// 'desc' => esc_html__( 'Год постройки глэмпинга', 'glamping-club' ),
		'id'   => 'price',
		'type' => 'text',
		'before_field' => '₽',
		'attributes' => array(
			'type' => 'number',
			'min'  => '1',
            'data-valid' => 'required-field',
			'data-name' => 'price'
		),
        'classes' => 'glc-form-group glc-form-group-price'
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
		'query_args' => array(
			'author' => get_current_user_id()
		),
	) );
}

function set_to_post_title($field_args, $field) {
    $post = get_post( $field->object_id );
    $title = '';
    if ($post->post_type == 'glampings') {
        $title = get_the_title( $field->object_id );
    }
    return $title;
}

function set_to_post_content($field_args, $field) {
    $post = get_post( $field->object_id );
    $content = '';
    if ($post->post_type == 'glampings') {
        $content = $post->post_content;
    }
    return $content;
}

function get_glamping_location_options() {
    $terms = get_terms( array(
        'hide_empty'  => 0,
        'taxonomy'    => 'location'
    ) );
    $term_obj = [];
    $term_obj[0] = esc_html__( 'Выберите регион', 'glamping-club' );
    foreach ($terms as $term) {
        $term_obj[$term->term_id] = $term->name;
    }
    return $term_obj;
}

function set_to_glamping_location_options($field_args, $field) {
    $post = get_post( $field->object_id );
    $term = [];
    if ($post->post_type == 'glampings') {
        $cur_terms = get_the_terms( $field->object_id, 'location' );
        $term = $cur_terms[0]->term_id;
    }
    return $term;
}

function set_to_post_thumbnail($field_args, $field) {
    $thumbnail_id = get_post_thumbnail_id($field->object_id);
    $thumbnail_url = get_the_post_thumbnail_url($field->object_id);
    return $thumbnail_url;
}
