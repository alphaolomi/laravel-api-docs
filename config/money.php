<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Laravel money
     |--------------------------------------------------------------------------
     */
    'locale' => config('app.locale', 'en_US'),
    'defaultCurrency' => config('app.currency', 'USD'),
    'defaultFormatter' => null,
    'isoCurrenciesPath' => __DIR__.'/../vendor/moneyphp/money/resources/currency.php',
    'currencies' => [
        'iso' => 'all',
        'bitcoin' => 'all',
        'custom' => [
            // 'MY1' => 2,
            // 'MY2' => 3
        ],

        // 'iso' => ['RUB', 'USD', 'EUR'],  // 'all' to choose all ISOCurrencies
        // 'bitcoin' => ['XBT'], // 'all' to choose all BitcoinCurrencies
        // 'custom' => [
        //     'MY1' => 2,
        //     'MY2' => 3
        // ]
    ],
];
