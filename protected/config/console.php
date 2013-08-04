<?php

//defined('APP_CFG') || define('APP_CFG',dirname(__FILE__).'/main.php');

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return CMap::mergeArray(
  require(dirname(__FILE__).DIRECTORY_SEPARATOR.'web_and_cmd.php'),
  array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'My Console Application',

    // preloading 'log' component
    'preload'=>array('log'),

    'import'=>array(
//      'application.models.*',
//      'application.components.*',
      'application.helpers.*',
//      'application.modules.currencymanager.models.*',
  // 		'application.extensions.yiidebugtb.*',
    ),

    // application components
    'components'=>array(
      'log'=>array(
        'class'=>'CLogRouter',
        'routes'=>array(
          array(
            'class'=>'CFileLogRoute',
            'levels'=>'error, warning',
          ),
        ),
      ),
    ),
    'commandMap' => array(
      'artefieri' => array(
        'class' => 'ext.artefieri.ArtefieriCommand',
      ),
    ),
  ),
  require(dirname(__FILE__).DIRECTORY_SEPARATOR.APP_ENV.'_db.php')
);