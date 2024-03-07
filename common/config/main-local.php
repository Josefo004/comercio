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
        'db2' => [ // Segunda conexión a otra base de datos
            'class' => 'yii\db\Connection',
            'dsn' => 'sqlsrv:Server=172.16.1.250;Database=Pagos;Encrypt=0;TrustServerCertificate=1',
            'username' => 'usrwebdj01',
            'password' => 'masterkey',
            'charset' => 'utf8',
            'on afterOpen' => function($event) {
                $event->sender->createCommand("SET DATEFORMAT DMY
                    SET LANGUAGE spanish
                ")->execute();
            }
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@app/mail',
            'useFileTransport' => false, // Cambiar a false para enviar correos reales
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com', // Configurar el servidor SMTP
                'username' => 'ventas@usfx.bo',
                'password' => 'S3l3ct2k24.',
                'port' => '587', // Puerto SMTP
                'encryption' => 'tls', // Tipo de cifrado (tls o ssl)
            ],
        ],
        // 'mailer' => [
        //     'class' => \yii\symfonymailer\Mailer::class,
        //     'viewPath' => '@common/mail',
            // send all mails to a file by default.
            // 'useFileTransport' => true,
            // You have to set
            //
            // 'useFileTransport' => false,
            //
            // and configure a transport for the mailer to send real emails.
            //
            // SMTP server example:
            //    'transport' => [
            //        'scheme' => 'smtps',
            //        'host' => '',
            //        'username' => '',
            //        'password' => '',
            //        'port' => 465,
            //        'dsn' => 'native://default',
            //    ],
            //
            // DSN example:
            //    'transport' => [
            //        'dsn' => 'smtp://user:pass@smtp.example.com:25',
            //    ],
            //
            // See: https://symfony.com/doc/current/mailer.html#using-built-in-transports
            // Or if you use a 3rd party service, see:
            // https://symfony.com/doc/current/mailer.html#using-a-3rd-party-transport
        // ],
    ],
];
