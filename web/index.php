<?php
date_default_timezone_set("Europe/Moscow");
// Using memcached as sessions store
//ini_set('session.save_handler', 'memcached');
//ini_set('session.save_path', '127.0.0.1:11211');
// change the following paths if necessary
// framework config include
require_once(dirname(__FILE__).'/protected/config/rapid.php');

$yii = $frameworkPath . 'yiilite.php';
$api = $apiPath . 'api.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
require_once($api);

$configMain = require(dirname(__FILE__) . '/protected/config/main.php');
$configApi = require($apiPath . 'config/main.php');
$config = CMap::mergeArray($configMain, $configApi);

/** @var $app CWebApplication */
$app = Yii::createWebApplication($config);

Api::init();

//if (Yii::app()->params['registry']['config']['techpage_is_under_construct_now'] == 1)
//    Yii::app()->catchAllRequest = array('site/UnderConstruction');

$app->run();