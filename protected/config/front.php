<?php

return CMap::mergeArray(
    require(dirname(__FILE__).'/main.php'),
    array(
        // Put front-end settings there
        // (for example, url rules).
		'name'=>'Artefieri',
    		
		// autoloading model and component classes
		'import'=>array(
			'application.extensions.*',
		),

    	'components'=>array(
		
			'urlManager'=>array(
				'urlFormat'=>'path',
				//'showScriptName'=>false,
				'rules'=>array(
					'<controller:\w+>/<id:\d+>'=>'<controller>/view',
					'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
					'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				),
			),
	
		),

	)
);