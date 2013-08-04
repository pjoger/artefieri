<?php

return array(
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
      'image'=>array(
          'class'=>'application.extensions.image.CImageComponent',
          // GD or ImageMagick
          'driver'=>'ImageMagick',
          // ImageMagick setup path
          //'params'=>array('directory'=>'/opt/local/bin'),
          'params'=>array('directory'=>'/usr/bin'),
      ),
      'artefieri' => array(
        'class' => 'application.extensions.artefieri.CArtefieriComponent',
        'coverSizes' => array(
          array(320,240),
          array(600,null),
          array(null,90),
        ),
      ),
    ),
);