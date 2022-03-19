<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            // 'dsn' => 'mysql:host=localhost:3306;dbname=nrk1987',
            'dsn' => 'mysql:host=77.222.52.178:3306;dbname=nrk1987',
            'username' => 'user_nrk1987_com',
            'password' => '5I2q0W6h',
            'charset' => 'utf8',
            'tablePrefix' => 'tbl_'
        ],
        
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'viewPath' => '@common/mail',
            'htmlLayout' => 'layouts/html',
            'textLayout' => 'layouts/text',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yandex.ru',
                'username' => 'info@nrk1987.com',
                'password' => 'xh7-PbG-YqL-7it',
                'port' => 465,
                'encryption' => 'ssl',
                'streamOptions' => [ 
                    'ssl' => [ 
                        'allow_self_signed' => true, 
                        'verify_peer' => false, 
                        'verify_peer_name' => false, 
                    ], 
                ],
            ],
        ],
    ]
];
