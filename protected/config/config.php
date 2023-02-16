<?php
return array(
    'app.name'=>'Video Chat',
    'app.timezone' => 'Europe/Berlin',// http://www.php.net/manual/en/timezones.php
    'app.default_language' => 'en',
    'app.host' => 'https://opentok.codecanyon',
    'app.base_url' => '/',
    'app.encryption_key' => 'uNFMVrvZ7pFKKCIwcU97HXAbUIvGm17i',
    'app.validation_key' => 'Jd3qhzghLY2ro7JHQfGgWiTZ6ph3osvU',
    'app.cookie_validation' => true,
    'app.command_key'=>'',

    // Database settings
    'db.host' => 'localhost',
    'db.dbname' => 'videochat',
    'db.username' => 'homestead',
    'db.password' => 'secret',
    'db.port' => 3306,

    // Cookie settings
    'cookie.secure' => false,
    'cookie.same_site' => 'Lax',

    // Template
    'template.head' => '',

    // Vonage credentials
    'vonage.key'=>'',
    'vonage.secret'=>'',

    // Params
    'param.token_time' => time() + 60 * 60 * 1,
    'param.sess_int_time'=>50 * 1000, // Milliseconds 50 * 1000 ms == 50 sec
    'param.data_sync'=>5 * 1000, // Milliseconds. Informer's and online users' widgets refresh rate
    'param.chat_refresh_rates'=>array(
        // Tick number => Time between requests
        0 	=> 1 * 1000,
        3 	=> 2 * 1000,
        10 	=> 5 * 1000,
        20	=> 15 * 1000,
        30	=> 30 * 1000,
    ),
    'param.developed_by'=>'<a href="http://php8developer.com">PHP8 Developer</a>',
);