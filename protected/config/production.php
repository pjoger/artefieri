<?php
/*
define('YII_DEBUG', true);
define('YII_TRACE_LEVEL', 3);
define('YII_ENABLE_ERROR_HANDLER', true);
define('YII_ENABLE_EXCEPTION_HANDLER', true);
*/
return array_replace_recursive(
  require dirname(__FILE__) . '/main.php',
  require dirname(__FILE__) . '/production_db.php'
);
