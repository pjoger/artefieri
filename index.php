<?php
$rootPath = dirname(__FILE__);
$confPath = $rootPath . '/protected/config';

require $confPath.'/auto_switch_conf.php';

$yii=$rootPath.'/framework/yii.php';
$config=$rootPath.'/protected/config/front.php';

// remove the following lines when in production mode
//defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
//defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);


require_once($yii);

//Yii::createWebApplication($config)->run();
Yii::createWebApplication($config)->runEnd('front');

