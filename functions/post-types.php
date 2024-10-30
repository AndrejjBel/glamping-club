<?php
if( ! defined('WP_POST_REVISIONS') ) define( 'WP_POST_REVISIONS', 1 );
add_action( 'init', 'glamping_club_register_post_types' );
function glamping_club_register_post_types(){

    register_taxonomy( 'location', [ 'glampings' ], [
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => [
			'name'              => 'Регионы',
			'singular_name'     => 'Регион',
			'search_items'      => 'Искать Регионы',
			'all_items'         => 'Все Регионы',
			'view_item '        => 'Смотреть Регион',
			'parent_item'       => 'Родительский Регион',
			'parent_item_colon' => 'Родительский Регион:',
			'edit_item'         => 'Редактировать Регион',
			'update_item'       => 'Изменить Регион',
			'add_new_item'      => 'Добавить Регион',
			'new_item_name'     => 'Новый Регион название',
			'menu_name'         => 'Регион',
			'back_to_items'     => '← Назад к Регионам',
		],
		'description'           => '', // описание таксономии
		'public'                => true,
		'hierarchical'          => true,
		'rewrite'               => true,
		'capabilities'          => array(),
		'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
		'show_admin_column'     => true, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
		'show_in_rest'          => true, // добавить в REST API
		'rest_base'             => null, // $taxonomy
	] );

    // register_taxonomy( 'glemp-tag', [ 'glampings' ], [
	// 	'label'                 => '', // определяется параметром $labels->name
	// 	'labels'                => [
	// 		'name'              => 'Теги',
	// 		'singular_name'     => 'Тег',
	// 		'search_items'      => 'Искать Тег',
	// 		'all_items'         => 'Все Теги',
	// 		'view_item '        => 'Смотреть Тег',
	// 		'parent_item'       => 'Родительский Регион',
	// 		'parent_item_colon' => 'Родительский Регион:',
	// 		'edit_item'         => 'Редактировать Тег',
	// 		'update_item'       => 'Изменить Тег',
	// 		'add_new_item'      => 'Добавить Тег',
	// 		'new_item_name'     => 'Новый Тег название',
	// 		'menu_name'         => 'Теги',
	// 		'back_to_items'     => '← Назад к Тегам',
	// 	],
	// 	'description'           => '', // описание таксономии
	// 	'public'                => true,
	// 	'hierarchical'          => false,
	// 	'rewrite'               => true,
	// 	'capabilities'          => array(),
	// 	'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
	// 	'show_admin_column'     => true, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
	// 	'show_in_rest'          => true, // добавить в REST API
	// 	'rest_base'             => null, // $taxonomy
	// ] );

	register_post_type( 'glampings', [
		'label'  => null,
		'labels' => [
			'name'               => 'Глэмпинги', // основное название для типа записи
			'singular_name'      => 'Глэмпинг', // название для одной записи этого типа
			'add_new'            => 'Добавить Глэмпинг', // для добавления новой записи
			'add_new_item'       => 'Добавление Глэмпинга', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование Глэмпинга', // для редактирования типа записи
			'new_item'           => 'Новый Глэмпинг', // текст новой записи
			'view_item'          => 'Смотреть Глэмпинг', // для просмотра записи этого типа.
			'search_items'       => 'Искать Глэмпинг', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Глэмпинги', // название меню
		],
		'description'            => '',
		'public'                 => true,
		'show_in_menu'           => true, // показывать ли в меню админки
		'show_in_rest'        => true, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-palmtree',
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'author', 'thumbnail', 'custom-fields', 'revisions' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => ['location'],
		'has_archive'         => true,
		'rewrite'             => true,
		'query_var'           => true,
	] );

// Отзывы
    // register_taxonomy( 'reviews-location', [ 'reviews' ], [
    //     'label'                 => '', // определяется параметром $labels->name
    //     'labels'                => [
    //         'name'              => 'Регионы отзывов',
    //         'singular_name'     => 'Регион отзыва',
    //         'search_items'      => 'Искать Регионы отзывов',
    //         'all_items'         => 'Все Регионы отзывов',
    //         'view_item '        => 'Смотреть Регион отзывов',
    //         'parent_item'       => 'Родительский Регион отзывов',
    //         'parent_item_colon' => 'Родительский Регион отзывов:',
    //         'edit_item'         => 'Редактировать Регион отзывов',
    //         'update_item'       => 'Изменить Регион отзывов',
    //         'add_new_item'      => 'Добавить Регион отзывов',
    //         'new_item_name'     => 'Новый Регион отзывов название',
    //         'menu_name'         => 'Регион отзывов',
    //         'back_to_items'     => '← Назад к Регионам отзывов',
    //     ],
    //     'description'           => '', // описание таксономии
    //     'public'                => true,
    //     'hierarchical'          => true,
    //     'rewrite'               => true,
    //     'capabilities'          => array(),
    //     'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
    //     'show_admin_column'     => true, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
    //     'show_in_rest'          => true, // добавить в REST API
    //     'rest_base'             => null, // $taxonomy
    // ] );

    register_post_type( 'reviews', [
		'label'  => null,
		'labels' => [
			'name'               => 'Отзывы', // основное название для типа записи
			'singular_name'      => 'Отзыв', // название для одной записи этого типа
			'add_new'            => 'Добавить Отзыв', // для добавления новой записи
			'add_new_item'       => 'Добавление Отзыва', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование Отзыва', // для редактирования типа записи
			'new_item'           => 'Новый Отзыв', // текст новой записи
			'view_item'          => 'Смотреть Отзыв', // для просмотра записи этого типа.
			'search_items'       => 'Искать Отзыв', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Отзывы', // название меню
		],
		'description'            => '',
		'public'                 => true,
		'show_in_menu'           => true, // показывать ли в меню админки
		'show_in_rest'        => true, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-star-filled',
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'author', 'thumbnail', 'custom-fields', 'comments', 'revisions' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		// 'taxonomies'          => ['reviews-location'],
		'has_archive'         => true,
		'rewrite'             => true,
		'query_var'           => true,
	] );

    register_post_type( 'stocks', [
		'label'  => null,
		'labels' => [
			'name'               => 'Акции', // основное название для типа записи
			'singular_name'      => 'Акция', // название для одной записи этого типа
			'add_new'            => 'Добавить Акцию', // для добавления новой записи
			'add_new_item'       => 'Добавление Акции', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование Акции', // для редактирования типа записи
			'new_item'           => 'Новая Акция', // текст новой записи
			'view_item'          => 'Смотреть Акцию', // для просмотра записи этого типа.
			'search_items'       => 'Искать Акцию', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Акции', // название меню
		],
        'description'            => '',
		'public'                 => true,
		'show_in_menu'           => true, // показывать ли в меню админки
		'show_in_rest'        => true, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-hourglass',
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'author', 'thumbnail', 'custom-fields', 'revisions' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		// 'taxonomies'          => ['location'],
		'has_archive'         => true,
		'rewrite'             => true,
		'query_var'           => true,
	] );

}
