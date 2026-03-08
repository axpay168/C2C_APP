<?php
/**
 * bbank 交易所配置
 * 可在 fa_config 表中覆蓋，或使用 .env
 */
return [
    'default' => 'bbank',
    'bbank' => [
        'base_url'   => 'https://api.bbank.com',
        'api_key'    => '',
        'api_secret' => '',
        'timeout'    => 30,
        'retry_times'=> 3,
    ],
];
