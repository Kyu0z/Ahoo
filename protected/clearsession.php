<?php
error_reporting(E_ALL & ~(E_NOTICE | E_DEPRECATED | E_STRICT));
mb_internal_encoding('UTF-8');

$config=dirname(__FILE__).'/config/console.php';

// fix for fcgi
defined('STDIN') or define('STDIN', fopen('php://stdin', 'r'));

defined('YII_DEBUG') or define('YII_DEBUG',false);

require_once(dirname(__FILE__).'/../framework/yii.php');

$app=Yii::createConsoleApplication($config);
$app->setTimeZone($app->params['app.timezone']);
$app->commandRunner->addCommands(YII_PATH.'/cli/commands');

$_SERVER['argv'] = array(
	Yii::app()->request->scriptFile,
	'clearsession',
	'removeall',
);

$env=@getenv('YII_CONSOLE_COMMANDS');

if(!empty($env))
	$app->commandRunner->addCommands($env);

$app->run();