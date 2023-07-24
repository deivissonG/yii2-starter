<?php

    return [
        'translations' => [
            '*' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@app/messages',
                'sourceLanguage' => 'en-US',
                'fileMap' => [
                    'settings' => 'settings.php',
                    'brand' => 'brand.php',
                    'product' => 'product.php',
                    'product_family' => 'product_family.php',
                    'product_family_product' => 'product_family_product.php',
                    'app/error' => 'error.php',
                    'app' => 'app.php',
                ],
            ],
        ],
    ];