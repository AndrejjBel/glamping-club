<?php
function type_options() {
    $site_options = get_option( 'glc_alloptions_page' );
    $options = [];
    foreach ($site_options['glamping_type'][0]['title'] as $key => $value) {
        $options[$value] = $value;
    }
    return $options;
}

function allocation_options() {
    $site_options = get_option( 'glc_alloptions_page' );
    $options = [];
    foreach ($site_options['glamping_allocation'][0]['title'] as $key => $value) {
        $options[$value] = $value;
    }
    return $options;
}

function facilities_options_general() {
    $site_options = get_option( 'glc_alloptions_page' );
    $options = [];
    foreach ($site_options['glamping_facilities_general'][0]['title'] as $key => $value) {
        $options[$value] = $value;
    }
    return $options;
}

function entertainment_options() {
    $site_options = get_option( 'glc_alloptions_page' );
    $options = [];
    foreach ($site_options['glamping_entertainment'][0]['title'] as $key => $value) {
        $options[$value] = $value;
    }
    return $options;
}


function nutrition_options() {
    $site_options = get_option( 'glc_alloptions_page' );
    $options = [];
    foreach ($site_options['glamping_nutrition'][0]['title'] as $key => $value) {
        $options[$value] = $value;
    }
    return $options;
}

function territory_options() {
    $site_options = get_option( 'glc_alloptions_page' );
    $options = [];
    foreach ($site_options['glamping_territory'][0]['title'] as $key => $value) {
        $options[$value] = $value;
    }
    return $options;
}

function working_mode_seasons() {
    $options = [
        'январь' => 'январь',
        'февраль' => 'февраль',
        'март' => 'март',
        'апрель' => 'апрель',
        'май' => 'май',
        'июнь' => 'июнь',
        'июль' => 'июль',
        'август' => 'август',
        'сентябрь' => 'сентябрь',
        'октябрь' => 'октябрь',
        'ноябрь' => 'ноябрь',
        'декабрь' => 'декабрь',
    ];
    return $options;
}

function facilities_options_home() {
    $site_options = get_option( 'glc_alloptions_page' );
    $options = [];
    foreach ($site_options['facilities_options_home'][0]['title'] as $key => $value) {
        $options[$value] = $value;
    }
    return $options;
}

function facilities_options_bathroom() {
    $site_options = get_option( 'glc_alloptions_page' );
    $options = [];
    foreach ($site_options['facilities_options_bathroom'][0]['title'] as $key => $value) {
        $options[$value] = $value;
    }
    return $options;
}

function facilities_options_kitchen() {
    $site_options = get_option( 'glc_alloptions_page' );
    $options = [];
    foreach ($site_options['facilities_options_kitchen'][0]['title'] as $key => $value) {
        $options[$value] = $value;
    }
    return $options;
}

function facilities_options_safety() {
    $site_options = get_option( 'glc_alloptions_page' );
    $options = [];
    foreach ($site_options['facilities_options_safety'][0]['title'] as $key => $value) {
        $options[$value] = $value;
    }
    return $options;
}

function facilities_options_children() {
    $site_options = get_option( 'glc_alloptions_page' );
    $options = [];
    foreach ($site_options['facilities_options_children'][0]['title'] as $key => $value) {
        $options[$value] = $value;
    }
    return $options;
}

function nature_around_options() {
    $site_options = get_option( 'glc_alloptions_page' );
    $options = [];
    foreach ($site_options['glamping_nature_around'][0]['title'] as $key => $value) {
        $options[$value] = $value;
    }
    return $options;
}

// Опции для настроек
function options_set() {
    $site_options = get_option( 'glc_alloptions_page' );

    $site_options['glamping_type'] = [
        [
            'title' => [
                'Глэмпинг',
                'Эко-отель',
                'Турбаза',
                'Частный сектор',
            ]
        ]
    ];

    $site_options['glamping_allocation'] = [
        [
            'title' => [
                'А-фрейм',
                'Барнхаус',
                'Белл-тент',
                'Вагончик',
                'Дом в лесу',
                'Дом на воде',
                'Дом на дереве',
                'Дом на колесах',
                'Дубльдом',
                'Зеркальный дом',
                'Купол',
                'Лотус-тент',
                'Модульный дом',
                'Сафари-тент',
                'Типи',
                'Эко-дом',
                'Юрта',
            ]
        ]
    ];

    $site_options['glamping_facilities_general'] = [
        [
            'title' => [
                'Wi-Fi',
                'Кондиционер',
                'Парковка',
                'Можно с животными',
            ]
        ]
    ];

    $site_options['facilities_options_home'] = [
        [
            'title' => [
                'Гардероб',
                'Диван',
                'Камин',
                'Кондиционер',
                'Мини-кухня',
                'Обогреватель',
                'Проектор',
                'Санузел',
                'Сейф',
                'Стиральная машина',
                'Стол',
                'Стулья',
                'Телевизор',
                'Теплый пол',
                'Утюг',
                'Шкаф',
                'Кухня (общая)',
                'Музыкальная колонка',
                'Санузел (общий)',
                'Яндекс.Станция Алиса',
            ]
        ]
    ];

    $site_options['facilities_options_bathroom'] = [
        [
            'title' => [
                'Гель для душа',
                'Душ',
                'Душ (общий)',
                'Мыло',
                'Набор полотенец',
                'Умывальник',
                'Тапочки',
                'Халат',
                'Фен',
                'Шампунь',
            ]
        ]
    ];

    $site_options['facilities_options_kitchen'] = [
        [
            'title' => [
                'Кофеварка',
                'Кофемашина',
                'Микроволновая печь',
                'Мини-бар',
                'Плита',
                'Посуда',
                'Посудомоечная машина',
                'Тостер',
                'Чайник',
                'Холодильник',
            ]
        ]
    ];

    $site_options['glamping_nutrition'] = [
        [
            'title' => [
                'Доставка еды',
                'Завтрак',
                'Питьевая вода',
                'Ресторан',
                'Трехразовое питание',
            ]
        ]
    ];

    $site_options['facilities_options_children'] = [
        [
            'title' => [
                'Детский уголок',
                'Детская площадка',
                'Детская кроватка по запросу',
            ]
        ]
    ];

    $site_options['glamping_territory'] = [
        [
            'title' => [
                'Бассейн',
                'Беседка',
                'Гамак',
                'Джакузи',
                'Игровая зона',
                'Качеля',
                'Мангал',
                'Терраса',
                'Ферма',
                'Шезлонг',
                'Костровая зона',
            ]
        ]
    ];

    $site_options['facilities_options_safety'] = [
        [
            'title' => [
                'Видеонаблюдение по территории',
                'Датчик дыма',
                'Охраняемая территория',
                'Охраняемая парковка',
            ]
        ]
    ];

    $site_options['glamping_entertainment'] = [
        [
            'title' => [
                'Аквапарк',
                'Аэрохоккей',
                'Бадминтон',
                'Багги',
                'Баскетбол',
                'Батут',
                'Беговые лыжи',
                'Библиотека',
                'Вейкборд',
                'Велосипед',
                'Виндсерфинг',
                'Волейбольная площадка',
                'Гидроциклы',
                'Горнолыжный курорт',
                'Дартс',
                'Йога',
                'Караоке',
                'Кайтсерфинг',
                'Кинотеатр',
                'Лазертаг',
                'Лодка',
                'Массаж',
                'Мотосноуборды',
                'Настольный теннис',
                'Прогулки на лошадях',
                'Рыбалка',
                'САП-борд',
                'Серфинг',
                'Скалодром',
                'Снегоход',
                'Эко-тропа',
                'Байдарки',
                'Квадроциклы',
                'Катамараны',
                'Настольные игры',
                'Веревочный парк',
                'Каяки',
                'Каток',
                'Пляж',
                'Приставка Dendi',
                'Рафтинг',
                'Теннисный корт',
                'Тир',
                'Тюбинги',
                'Фотосессия',
                'Фрисби',
                'Футбольная площадка',
                'Экскурсии',
                'Эндуро',
                'Яхтинг',
                'PlayStation'
            ]
        ]
    ];

    $site_options['glamping_nature_around'] = [
        [
            'title' => [
                'Лес',
                'Горы',
                'Река',
                'Озеро',
                'Море',
                'Поле',
            ]
        ]
    ];

    update_option( 'glc_alloptions_page', $site_options );

    // return $site_options;
}

function options_set_js() {
    $options_set_js = [
    'glamping_facilities_general' => [
        'Wi-Fi',
        'Кондиционер',
        'Парковка',
        'Можно с животными',
    ],

    'facilities_options_home' => [
        'Гардероб',
        'Диван',
        'Камин',
        'Кондиционер',
        'Мини-кухня',
        'Обогреватель',
        'Проектор',
        'Санузел',
        'Сейф',
        'Стиральная машина',
        'Стол',
        'Стулья',
        'Телевизор',
        'Теплый пол',
        'Утюг',
        'Шкаф',
        'Кухня (общая)',
        'Музыкальная колонка',
        'Санузел (общий)',
        'Яндекс.Станция Алиса',
    ],

    'facilities_options_bathroom' => [
        'Гель для душа',
        'Душ',
        'Душ (общий)',
        'Мыло',
        'Набор полотенец',
        'Умывальник',
        'Тапочки',
        'Халат',
        'Фен',
        'Шампунь',
    ],

    'facilities_options_kitchen' => [
        'Кофеварка',
        'Кофемашина',
        'Микроволновая печь',
        'Мини-бар',
        'Плита',
        'Посуда',
        'Посудомоечная машина',
        'Тостер',
        'Чайник',
        'Холодильник',
    ],

    'glamping_nutrition' => [
        'Доставка еды',
        'Завтрак',
        'Питьевая вода',
        'Ресторан',
        'Трехразовое питание',
    ],

    'facilities_options_children' => [
        'Детский уголок',
        'Детская площадка',
        'Детская кроватка по запросу',
    ],

    'glamping_territory' => [
        'Бассейн',
        'Беседка',
        'Гамак',
        'Джакузи',
        'Игровая зона',
        'Качеля',
        'Мангал',
        'Терраса',
        'Ферма',
        'Шезлонг',
        'Костровая зона',
    ],

    'facilities_options_safety]' => [
        'Видеонаблюдение по территории',
        'Датчик дыма',
        'Охраняемая территория',
        'Охраняемая парковка',
    ],

    'glamping_entertainment' => [
        'Аквапарк',
        'Аэрохоккей',
        'Бадминтон',
        'Багги',
        'Баскетбол',
        'Батут',
        'Беговые лыжи',
        'Библиотека',
        'Вейкборд',
        'Велосипед',
        'Виндсерфинг',
        'Волейбольная площадка',
        'Гидроциклы',
        'Горнолыжный курорт',
        'Дартс',
        'Йога',
        'Караоке',
        'Кайтсерфинг',
        'Кинотеатр',
        'Лазертаг',
        'Лодка',
        'Массаж',
        'Мотосноуборды',
        'Настольный теннис',
        'Прогулки на лошадях',
        'Рыбалка',
        'САП-борд',
        'Серфинг',
        'Скалодром',
        'Снегоход',
        'Эко-тропа',
        'Байдарки',
        'Квадроциклы',
        'Катамараны',
        'Настольные игры',
        'Веревочный парк',
        'Каяки',
        'Каток',
        'Пляж',
        'Приставка Dendi',
        'Рафтинг',
        'Теннисный корт',
        'Тир',
        'Тюбинги',
        'Фотосессия',
        'Фрисби',
        'Футбольная площадка',
        'Экскурсии',
        'Эндуро',
        'Яхтинг',
        'PlayStation'
    ],

    'glamping_nature_around' => [
        'Лес',
        'Горы',
        'Река',
        'Озеро',
        'Море',
        'Поле',
    ]
];

    return $options_set_js;
}
