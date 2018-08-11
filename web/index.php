<?php
error_reporting(E_ALL);

define("APP_DIR", "req/");
define("DATA_DIR", "store/");

define("CORE_DIR", "Core/");
define("HANDLER_DIR", "Handler/");
define("LIBRARY_DIR", "Library/");
define("MODEL_DIR", "Model/");
define("VISUALIZER_DIR", "Visualizer/");

define("DEFAULT_HANDLER", "index");
define("DEFAULT_ACTION", "index");
define("SQL_DEBUG", false);

require_once( "../vendor/autoload.php" );
require_once( "../RedisSessionHandler.php" );

$redis = new Predis\Client([
    'host' => parse_url($_ENV['REDIS_URL'], PHP_URL_HOST),
    'port' => parse_url($_ENV['REDIS_URL'], PHP_URL_PORT),
    'password' => parse_url($_ENV['REDIS_URL'], PHP_URL_PASS),
]);
$sessHandler = new RedisSessionHandler($redis);
session_set_save_handler($sessHandler);
session_start();

require APP_DIR . "App.php";
?>	