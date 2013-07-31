<?php
$rootPath = dirname(__FILE__);
$confPath = $rootPath . '/protected/config';

require $confPath.'/auto_switch_conf.php';

// change the following paths if necessary
$yii=$rootPath.'/framework/yii.php';
$config = $confPath.'/back.php';

require_once($yii);
Yii::createWebApplication($config)->runEnd('back');