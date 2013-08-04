<?php
/*
define('YII_DEBUG', true);
define('YII_TRACE_LEVEL', 3);
define('YII_ENABLE_ERROR_HANDLER', true);
define('YII_ENABLE_EXCEPTION_HANDLER', true);
*/
return array_replace_recursive(
  require dirname(__FILE__) . '/main.php',
  require dirname(__FILE__) . '/dev_db.php',
  array(
    'components' => array(
      'log'=>array(
        'class'=>'CLogRouter',
        'routes'=>array(
          /*array(
            'class'=>'CFileLogRoute',
            'levels'=>'trace, info, error, warning, profile',
            'filter'=>'CLogFilter',
  // 					'categories'=>'system.*',
          ),//*/
          array(
            // направляем результаты профайлинга в ProfileLogRoute (отображается
            // внизу страницы)
            'class'=>'CProfileLogRoute',
            'levels'=>'profile',
            'enabled'=>true,
          ),//*/
// 				array(
// 					'class' => 'CWebLogRoute',
// 					'categories' => 'application',
// 					'levels'=>'error, warning, trace, profile, info',
// 					'showInFireBug' => true
// 				),
// 				array( // configuration for the toolbar
// 					'class'=>'XWebDebugRouter',
// 					'config'=>'alignLeft, opaque, runInDebug, fixedPos, collapsed, yamlStyle',
// 					'levels'=>'error, warning, trace, profile, info',
// 					'allowedIPs'=>array('127.0.0.1','::1','192.168.17.136','192\.168\.1[0-5]\.[0-9]{3}'),
// 				),
          // uncomment the following to show log messages on web pages
          /*
          array(
            'class'=>'CWebLogRoute',
          ),
          */
        ),
      ),
    ),
  )
);
