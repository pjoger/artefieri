<?php

return CMap::mergeArray(
    require(dirname(__FILE__).'/main.php'),
    array(
        // Put back-end settings there.
		'name'=>'Artefieri',
		
		// autoloading model and component classes
		'import'=>array(
		),
		
		'modules'=>array(
				
			// uncomment the following to enable the Gii tool
			'gii'=>array(
				'class'=>'system.gii.GiiModule',
				'password'=>'admin',
				// If removed, Gii defaults to localhost only. Edit carefully to taste.
				'ipFilters'=>array('127.0.0.1','::1'),
				'generatorPaths' => array(
						'ext.awegen',
				),			
			),
			
		),

    	'components'=>array(
		
			/*'urlManager'=>array(
				'urlFormat'=>'path',
				//'showScriptName'=>false,
				'rules'=>array(
					'backend'=>'admin/login',
					//'backend'=>'site/index',
					'backend/<_c>'=>'<_c>',
					'backend/<_c>/<_a>'=>'<_c>/<_a>',
				),
			),*/
		
				'decoda' => array(
						'class' => 'application.extensions.decoda.YiiDecoda',
						'defaults' => true,
						'vendorPath' => 'application.extensions.decoda.vendors.decoda',
						
// 						'addHooks' => array('Emoticon', 'Code', 'Empty'),
						'removeHooks' => array('Censor', 'Clickable','Code'),
// 						'disableHooks' => false,
						
 						'addFilters' => array('Block', 'Code', 'Default', 'Email', 'Empty', 'Image', 'List', 'Quote', 'Text', 'Url', 'Video', 'GMap', 'Cdata'),
 						'removeFilters' => array('Text'),
  						'locale' => 'en-us',
 						'useXHTML' => true,
// 						'whitelistTags' => array('code', 'b', 'i', 'url', 'u', 'img', 'size', 'ul', 'li', 'list', '*'),
						'convertWhitespaces' => false,
						'disableParsing' => false,
				),	
    				
				'image'=>array(
					'class'=>'ImgManager',
					'versions'=>array(
						'small'=>array('width'=>120,'height'=>120),
						'medium'=>array('width'=>320,'height'=>320),
						'large'=>array('width'=>640,'height'=>640),
					),
				),
    			
    			'bbcodedecode' => array(
    					'class' => 'application.components.bbcodedecode',
    			),
    			 
			),
		
    )
);