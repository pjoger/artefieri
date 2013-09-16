<?php

/**
 * Define config
 */
$env = null;
$envFile = $rootPath . '/.env';
if (is_file($envFile)) {
    $env = trim(file_get_contents($envFile));
}

$configFile = $rootPath . '/protected/config/production.php';
if (!empty($env)) {
  $configFile = $rootPath . '/protected/config/' . $env . '.php';
  define('APP_ENV',$env);
  define('YII_DEBUG', true);
  define('YII_TRACE_LEVEL', 3);
}
if (!file_exists($configFile)) {
  die("Config file '$configFile' is not found.");
}
defined('APP_ENV') || define('APP_ENV','production');
defined('APP_isDevelComp') || define('APP_isDevelComp',APP_ENV != 'production');
defined('APP_COVERURL') || define('APP_COVERURL',APP_isDevelComp ? 'http://artefieri.ru' : '');
define('APP_CFG',$configFile);
