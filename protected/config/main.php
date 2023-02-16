<?php
$cfg_main = __DIR__.DIRECTORY_SEPARATOR."config.php";
$cfg_local = __DIR__.DIRECTORY_SEPARATOR."config_local.php";
$params = is_file($cfg_local) ? require $cfg_local : require $cfg_main;

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>$params['app.name'],
    'language' => $params['app.default_language'],
    'timeZone' => $params['app.timezone'],
	'defaultController' => 'Videochat',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	// application components
	'components'=>array(
		'user'=>array(
			'allowAutoLogin'=>false,
			'loginUrl' => array('videochat/login'),
			'returnUrl' => array('videochat/index'),
            'identityCookie'=>array(
                'httpOnly' => true,
                'path' => $params['app.base_url'],
                'secure'=> $params['cookie.secure'],
                'sameSite'=> $params['cookie.same_site'],
            ),
		),

        'db'=>array(
            'connectionString' => "mysql:host={$params['db.host']};dbname={$params['db.dbname']};port={$params['db.port']}",
            'emulatePrepare' => true,
            'username' => $params['db.username'],
            'password' => $params['db.password'],
            'charset' => 'utf8mb4',
            'tablePrefix' => 'vc_',
            //'enableParamLogging' => true,
            //'enableProfiling' => true,
            'schemaCachingDuration' => 60 * 60 * 24 * 30,
        ),

		'cache'=>array(
			'class'=>'CFileCache',
		),

        'securityManager' => array(
            'encryptionKey'=>$params['app.encryption_key'],
            'validationkey'=>$params['app.validation_key'],
        ),

        'session'=>array(
            'cookieParams'=>array(
                'httponly' => true,
                'path' => $params['app.base_url'],
                'secure'=> $params['cookie.secure'],
                'samesite'=> $params['cookie.same_site'],
            ),
        ),

        'request'=>array(
            'enableCookieValidation'=>$params['app.cookie_validation'],
            'csrfCookie' => array(
                'httpOnly' => true,
                'path' => $params['app.base_url'],
                'secure'=> $params['cookie.secure'],
                'sameSite'=> $params['cookie.same_site'],
            ),
        ),

        'clientScript'=>array(
            'packages'=>array(
                'jquery'=>array(
                    'baseUrl'=>'static/js',
                    'js'=>array('jquery.min.js'),
                ),
            ),
        ),

        'errorHandler'=>array(
            'errorAction'=>'videochat/error',
        ),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
					//'levels'=>'trace, info',
				),
				// uncomment the following to show log messages on web pages
				/*array(
					'class'=>'CWebLogRoute',
				),*/
			),
		),
	),

    'params'=>$params,
);