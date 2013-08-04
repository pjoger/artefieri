<?php

$rootPath = dirname(__FILE__).'/..';
$confPath = dirname(__FILE__).'/config';
require $confPath.'/auto_switch_conf.php';

// change the following paths if necessary
$yiic=dirname(__FILE__).'/../framework/yiic.php';
$config=dirname(__FILE__).'/config/console.php';

require_once($yiic);
