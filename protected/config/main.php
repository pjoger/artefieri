<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	//'name'=>'Artefieri 2',
	'sourceLanguage' => 'en_US',
	'language' => 'ru',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.helpers.*',
		'application.modules.currencymanager.models.*',
// 		'application.extensions.yiidebugtb.*',
	),

	'modules' => array(
		'currencymanager',
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'class'=>'WebUser',
		),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		'db'=>array(
			//'connectionString' => 'mysql:host=localhost;dbname=shopart',
			'connectionString' => 'mysql:host=localhost;dbname=DB',
			'emulatePrepare' => true,
			'username' => 'user',
			'password' => '*****',
			'charset' => 'utf8',
			// включаем профайлер
			'enableProfiling'=>true,
			// показываем значения параметров
			'enableParamLogging' => true,
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				/*array(
					'class'=>'CFileLogRoute',
					'levels'=>'trace, info, error, warning, profile',
					'filter'=>'CLogFilter',
// 					'categories'=>'system.*',
				),//*/
/*				array(
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
		'geoip' => array(
			'class' => 'application.extensions.geoip.CGeoIP',
			// specify filename location for the corresponding database
			'filename' => '/home/work/artefieri/protected/extensions/geoip/GeoLiteCity.dat',
			// Choose MEMORY_CACHE or STANDARD mode
			'mode' => 'STANDARD',
		),
		'session' => array(
			'class' => 'application.extensions.MyCDbHttpSession',
			'connectionID' => 'db',
			'sessionTableName'  =>  'sessions',
			'autoCreateSessionTable'   =>  false,
			//Extension properties
			'compareIpAddress'=>true,
			'compareUserAgent'=>true,
			'compareIpBlocks'=>0,
//			'useTransparentSessionID'   =>($_POST['PHPSESSID']) ? true : false,
			'cookieMode' => 'only',
			'autoStart' => false,
		),
		'cookie' => array (
			'class' => 'application.components.Cookie',
		),
		'location' => array(
			'class' => 'application.components.Location',
		),
		'image'=>array(
				'class'=>'application.extensions.image.CImageComponent',
				// GD or ImageMagick
				'driver'=>'ImageMagick',
				// ImageMagick setup path
				//'params'=>array('directory'=>'/opt/local/bin'),
				'params'=>array('directory'=>'/usr/bin'),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'enderr@mad.scientist.com',
   	'filtre' => '{"cat":"0", "limit":"1"}',
    'coverSize' => array(
      array(360,240),
      array(600,null),
    ),
	),

	'behaviors'=>array(
		'runEnd'=>array(
			'class'=>'application.components.WebApplicationEndBehavior',
		),
		'ApplicationConfigBehavior',
	),

);
