<?php
function entertainment_options() {
    $options = [
        'Аквапарк' => 'Аквапарк',
        'Аэрохоккей' => 'Аэрохоккей',
        'Бадминтон' => 'Бадминтон',
        'Багги' => 'Багги',
        'Баскетбол' => 'Баскетбол',
        'Батут' => 'Батут',
        'Беговые лыжи' => 'Беговые лыжи',
        'Библиотека' => 'Библиотека',
        'Вейкборд' => 'Вейкборд',
        'Велосипед' => 'Велосипед',
        'Виндсерфинг' => 'Виндсерфинг',
        'Волейбольная площадка' => 'Волейбольная площадка',
        'Гидроциклы' => 'Гидроциклы',
        'Горнолыжный курорт' => 'Горнолыжный курорт',
        'Дартс' => 'Дартс',
        'Йога' => 'Йога',
        'Караоке' => 'Караоке',
        'Кайтсерфинг' => 'Кайтсерфинг',
        'Кинотеатр' => 'Кинотеатр',
        'Лазертаг' => 'Лазертаг',
        'Лодка' => 'Лодка',
        'Массаж' => 'Массаж',
        'Мотосноуборды' => 'Мотосноуборды',
        'Настольный теннис' => 'Настольный теннис',
        'Прогулки на лошадях' => 'Прогулки на лошадях',
        'Рыбалка' => 'Рыбалка',
        'САП-борд' => 'САП-борд',
        'Серфинг' => 'Серфинг',
        'Скалодром' => 'Скалодром',
        'Снегоход' => 'Снегоход',
        'Эко-тропа' => 'Эко-тропа',
        'Байдарки' => 'Байдарки',
        'Квадроциклы' => 'Квадроциклы',
        'Катамараны' => 'Катамараны',
        'Настольные игры' => 'Настольные игры',
        'Веревочный парк' => 'Веревочный парк',
        'Каяки' => 'Каяки',
        'Каток' => 'Каток',
        'Пляж' => 'Пляж',
        'Приставка Dendi' => 'Приставка Dendi',
        'Рафтинг' => 'Рафтинг',
        'Теннисный корт' => 'Теннисный корт',
        'Тир' => 'Тир',
        'Тюбинги' => 'Тюбинги',
        'Фотосессия' => 'Фотосессия',
        'Фрисби' => 'Фрисби',
        'Футбольная площадка' => 'Футбольная площадка',
        'Экскурсии' => 'Экскурсии',
        'Эндуро' => 'Эндуро',
        'Яхтинг' => 'Яхтинг',
        'PlayStation' => 'PlayStation'
    ];
    return $options;
}

function facilities_options() {
    $options = [
        // В доме:
        'Гардероб' => 'Гардероб',
        'Диван' => 'Диван',
        'Камин' => 'Камин',
        'Кондиционер' => 'Кондиционер',
        'Мини-кухня' => 'Мини-кухня',
        'Обогреватель' => 'Обогреватель',
        'Проектор' => 'Проектор',
        'Санузел' => 'Санузел',
        'Сейф' => 'Сейф',
        'Стиральная машина' => 'Стиральная машина',
        'Стол' => 'Стол',
        'Стулья' => 'Стулья',
        'Телевизор' => 'Телевизор',
        'Теплый пол' => 'Теплый пол',
        'Утюг' => 'Утюг',
        'Шкаф' => 'Шкаф',
        'Кухня (общая)' => 'Кухня (общая)',
        'Музыкальная колонка' => 'Музыкальная колонка',
        'Санузел (общий)' => 'Санузел (общий)',
        'Яндекс.Станция Алиса' => 'Яндекс.Станция Алиса',

        // Ванная комната:
        'Гель для душа' => 'Гель для душа',
        'Душ' => 'Душ',
        'Душ (общий)' => 'Душ (общий)',
        'Мыло' => 'Мыло',
        'Набор полотенец' => 'Набор полотенец',
        'Умывальник' => 'Умывальник',
        'Тапочки' => 'Тапочки',
        'Халат' => 'Халат',
        'Фен' => 'Фен',
        'Шампунь' => 'Шампунь',

        // Дети:
        'Детская кроватка по запросу' => 'Детская кроватка по запросу',

        // Домашние животные:
        'Можно с животными' => 'Можно с животными',
        'Возможно размещение с животными при предварительном согласовании' => 'Возможно размещение с животными при предварительном согласовании',
        'Размещение с животными не допускается' => 'Размещение с животными не допускается',

        // Интернет:
        'Wi-Fi' => 'Wi-Fi',

        // Кухня:
        'Кофеварка' => 'Кофеварка',
        'Кофемашина' => 'Кофемашина',
        'Микроволновая печь' => 'Микроволновая печь',
        'Мини-бар' => 'Мини-бар',
        'Плита' => 'Плита',
        'Посуда' => 'Посуда',
        'Посудомоечная машина' => 'Посудомоечная машина',
        'Тостер' => 'Тостер',
        'Чайник' => 'Чайник',
        'Холодильник' => 'Холодильник',

        // Парковка:
        'Парковка' => 'Парковка',

        // Спальня:
        'Комод' => 'Комод',
        'Кровать King Size' => 'Кровать King Size',
        'Ортопедический матрас' => 'Ортопедический матрас',
        'Тумба' => 'Тумба',
        'Электропростынь' => 'Электропростынь',

        // SPA:
        'Баня (сауна)' => 'Баня (сауна)',
        'Фурако (купель)' => 'Фурако (купель)',
        'Банный чан' => 'Банный чан'
    ];
    return $options;
}

function nutrition_options() {
    $options = [
        'Доставка еды' => 'Доставка еды',
        'Завтрак' => 'Завтрак',
        'Питьевая вода' => 'Питьевая вода',
        'Ресторан' => 'Ресторан',
        'Трехразовое питание' => 'Трехразовое питание',
    ];
    return $options;
}

function territory_options() {
    $options = [
        'Бассейн' => 'Бассейн',
        'Беседка' => 'Беседка',
        'Гамак' => 'Гамак',
        'Джакузи' => 'Джакузи',
        'Игровая зона' => 'Игровая зона',
        'Качеля' => 'Качеля',
        'Мангал' => 'Мангал',
        'Терраса' => 'Терраса',
        'Ферма' => 'Ферма',
        'Шезлонг' => 'Шезлонг',
        'Костровая зона' => 'Костровая зона',
    ];
    return $options;
}

function type_options() {
    $options = [
        'Глэмпинг' => 'Глэмпинг',
        'Эко-отель' => 'Эко-отель',
        'Турбаза' => 'Турбаза',
        'Частный сектор' => 'Частный сектор',
    ];
    return $options;
}

function allocation_options() {
    $options = [
        'А-фрейм' => 'А-фрейм',
        'Барнхаус' => 'Барнхаус',
        'Белл-тент' => 'Белл-тент',
        'Вагончик' => 'Вагончик',
        'Дом в лесу' => 'Дом в лесу',
        'Дом на воде' => 'Дом на воде',
        'Дом на дереве' => 'Дом на дереве',
        'Дом на колесах' => 'Дом на колесах',
        'Дубльдом' => 'Дубльдом',
        'Зеркальный дом' => 'Зеркальный дом',
        'Купол' => 'Купол',
        'Лотус-тент' => 'Лотус-тент',
        'Модульный дом' => 'Модульный дом',
        'Сафари-тент' => 'Сафари-тент',
        'Типи' => 'Типи',
        'Эко-дом' => 'Эко-дом',
        'Юрта' => 'Юрта',
    ];
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

function facilities_options_general() {
    $options = [
        'Wi-Fi' => 'Wi-Fi',
        'Кондиционер' => 'Кондиционер',
        'Парковка' => 'Парковка',
        'Можно с животными' => 'Можно с животными',
    ];
    return $options;
}

function facilities_options_home() {
    $options = [
        'Гардероб' => 'Гардероб',
        'Диван' => 'Диван',
        'Камин' => 'Камин',
        'Кондиционер' => 'Кондиционер',
        'Мини-кухня' => 'Мини-кухня',
        'Обогреватель' => 'Обогреватель',
        'Проектор' => 'Проектор',
        'Санузел' => 'Санузел',
        'Сейф' => 'Сейф',
        'Стиральная машина' => 'Стиральная машина',
        'Стол' => 'Стол',
        'Стулья' => 'Стулья',
        'Телевизор' => 'Телевизор',
        'Теплый пол' => 'Теплый пол',
        'Утюг' => 'Утюг',
        'Шкаф' => 'Шкаф',
        'Кухня (общая)' => 'Кухня (общая)',
        'Музыкальная колонка' => 'Музыкальная колонка',
        'Санузел (общий)' => 'Санузел (общий)',
        'Яндекс.Станция Алиса' => 'Яндекс.Станция Алиса',
    ];
    return $options;
}

function facilities_options_bathroom() {
    $options = [
        'Гель для душа' => 'Гель для душа',
        'Душ' => 'Душ',
        'Душ (общий)' => 'Душ (общий)',
        'Мыло' => 'Мыло',
        'Набор полотенец' => 'Набор полотенец',
        'Умывальник' => 'Умывальник',
        'Тапочки' => 'Тапочки',
        'Халат' => 'Халат',
        'Фен' => 'Фен',
        'Шампунь' => 'Шампунь',
    ];
    return $options;
}

function facilities_options_kitchen() {
    $options = [
        'Кофеварка' => 'Кофеварка',
        'Кофемашина' => 'Кофемашина',
        'Микроволновая печь' => 'Микроволновая печь',
        'Мини-бар' => 'Мини-бар',
        'Плита' => 'Плита',
        'Посуда' => 'Посуда',
        'Посудомоечная машина' => 'Посудомоечная машина',
        'Тостер' => 'Тостер',
        'Чайник' => 'Чайник',
        'Холодильник' => 'Холодильник',
    ];
    return $options;
}

function facilities_options_safety() {
    $options = [
        'Видеонаблюдение по территории' => 'Видеонаблюдение по территории',
        'Датчик дыма' => 'Датчик дыма',
        'Охраняемая территория' => 'Охраняемая территория',
        'Охраняемая парковка' => 'Охраняемая парковка',
    ];
    return $options;
}

function facilities_options_children() {
    $options = [
        'Детский уголок' => 'Детский уголок',
        'Детская площадка' => 'Детская площадка',
        'Детская кроватка по запросу' => 'Детская кроватка по запросу',
    ];
    return $options;
}

function nature_around_options() {
    $options = [
        'Лес' => 'Лес',
        'Горы' => 'Горы',
        'Река' => 'Река',
        'Озеро' => 'Озеро',
        'Море' => 'Море',
        'Поле' => 'Поле',
    ];
    return $options;
}

// Опции для настроек
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
