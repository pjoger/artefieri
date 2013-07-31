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
  define('YII_DEBUG', true);
  define('YII_TRACE_LEVEL', 3);
}
if (!file_exists($configFile)) {
  die("Config file '$configFile' is not found.");
}
define('APP_CFG',$configFile);
