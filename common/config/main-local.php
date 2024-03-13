<?php

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'sqlsrv:Server=172.16.1.250;Database=Ecommerce;Encrypt=0;TrustServerCertificate=1',
            'username' => 'sa',
            'password' => 'sapo',
            'charset' => 'utf8',
            'on afterOpen' => function($event) {
                $event->sender->createCommand("SET DATEFORMAT DMY
                    SET LANGUAGE spanish
                   
                    ")->execute();
            }
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false, 
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com', 
                // 'username' => 'secretaria.mdhs@gmail.com', 
                'username' => 'dtic.mail@usfx.bo', 
                // 'password' => 'hlpehitoscwhmzwe',
                'password' => '9511*dtic1',
                'port' => '587',
                'encryption' => 'tls',
            ],
            'viewPath' => '@app/views/email',
        ],
    ],
];
