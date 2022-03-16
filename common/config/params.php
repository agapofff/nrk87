<?php
return [
    'adminEmail' => 'info@nrk1987.com',
    'supportEmail' => 'info@nrk1987.com',
    'senderEmail' => 'info@nrk1987.com',
    'senderName' => 'NRK1987',
    'user.passwordResetTokenExpire' => 3600,
    'user.passwordMinLength' => 8,
    // 'languages' => [
        // 'Русский' => 'ru',
        // 'English' => 'en',
        // 'Việt nam' => 'vi',
        // 'Deutsch' => 'de',
        // 'Қазақ' => 'kz',
        // "O'zbek" => 'uz',
        // 'Українська' => 'ua',
    // ],
    'h1' => '',
    'title' => '',
    'description' => '',
    'colors' => [
        'primary',
        'info',
        'secondary',
        'warning',
        'light',
        'dark',
    ],
    'store_types' => [
        0 => 'не МЛМ',
        1 => 'МЛМ',
        2 => 'Скидка',
    ],
    'default_store_type' => 0,
    'store_type' => 0,
    'currency' => 'RUB',
    'socials' => [
        'Facebook' => [
            'name' => 'nrk1987.wear',
            'link' => 'https://www.facebook.com/nrk1987.wear',
        ],
        'TikTok' => [
            'name' => 'nrk1987.wear',
            'link' => 'https://www.tiktok.com/@nrk1987.wear',
        ],
        'Instagram' => [
            'name' => 'nrk87.wear',
            'link' => 'https://www.instagram.com/nrk87.wear',
        ],
        'Vkontakte' => [
            'name' => 'nrk1987.wear',
            'link' => 'https://vk.com/nrk87com',
        ],
        'Youtube' => [
            'name' => 'nrk87',
            'link' => 'https://www.youtube.com/channel/UC_iVum1wE34wTzSY0WxjNGA',
        ],
        'Telegram' => [
            'name' => 'nrk87.wear',
            'link' => 'https://t.me/nrk87',
        ],
    ],
    'boutiquePlaces' => [
        'earth' => Yii::t('back', 'Адрес на Земле'),
        'mars' => Yii::t('back', 'Адрес на Марсе'),
    ],
	'contacts' => [
        'Австрия' => [
            'Вена' => [
                [
                    'address' => Yii::t('front', 'Москва, Пресненская наб., 6, стр. 2'),
                    'address_2' => [
                        Yii::t('front', 'Москва, Пресненская наб., 6, стр. 2'),
                        Yii::t('front', '2 подъезд, 12 этаж, офис 10')
                    ],
                    'phone' => '8-800-555-27-21',
                    'email' => 'info@nrk1987.com',
                    'worktime' => [
                        'Будни' => '9:00 - 23:00',
                        'Выходные' => '9:00 - 18:00'
                    ],
                    'coordinates' => [
                        55.74826,
                        37.540829
                    ],
                ]
            ],
        ],
        'Россия' => [
            'Москва' => [
                [
                    'address' => [
                        Yii::t('front', 'Москва, Пресненская наб., 6, стр. 2'),
                        Yii::t('front', '2 подъезд, 12 этаж, офис 10')
                    ],
                    'phone' => '8-800-555-27-21',
                    'email' => 'info@nrk1987.com',
                    'worktime' => [
                        'Будни' => '9:00 - 23:00',
                        'Выходные' => '9:00 - 18:00'
                    ],
                    'coordinates' => [
                        55.74826,
                        37.540829
                    ],
                ]
            ],
        ],
	],
    'hideNotAvailable' => false, // скрывать недоступные товары
    // 'scanToWin' => [
        // 'considerOrderStatus' => false, // учитывать статус чека в розыгрыше (активно / не активно)
    // ],
    
    'dadataApiKey' => 'f5f182cc08d1cd3bf72596625e1b6f853bcf63c4',
    
    // товар в подарок
    'gift' => [
        'product_id' => 84,
        'count' => 1,
        'price' => 0,
        'disableAddToCart' => true,
    ],
	
	'facebookPixelID' => '323610652739800',
	'facebookAccessToken' => 'EAAH9nQtUZC9wBAEnNWscm3q93ZBt35ahabS5Up0gfD8icX7hm2Cuo4fqHZC9llGFFA2pBjzYuIZAGYZCtkCqRKUBrViBo2Dlo0SGObLrW7wsIwqGZBz9PCpMuY6FqhcfLnxsKLTnyOYuP2TsdyYWNehpZAZA2M64Rgayuc5EZAO13bTaa5e2HNE0wiMRylWbPZBuMZD',
	'test_event_code' => 'TEST90632'
];
