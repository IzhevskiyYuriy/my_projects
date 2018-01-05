<?php
session_start();
//error_reporting(-1);//временно

use fw\core\Router;


$query = rtrim($_SERVER['QUERY_STRING'], '/');

define('WWW', __DIR__);
define('CORE', dirname(__DIR__) . '/vendor/fw/core');
define('ROOT', dirname(__DIR__));
define('APP',  dirname(__DIR__) . '/app');
define('IMG', dirname(__DIR__).'/public/upload image/images/');
define('IMG_TEMP', dirname(__DIR__).'/public/upload image/temp/');
define ('LAYOUT', 'default');

require '../vendor/fw/libs/functions.php';
require '../vendor/fw/libs/Validator.php';
require __DIR__.'/../vendor/autoload.php';

Router::addRoutes('^HomePage/?(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller' => 'HomePage']);
Router::addRoutes('^Task/?(?P<action>[a-zA-Z0-9]+)/(?P<alias>[a-zA-Z0-9]+)$', ['controller' => 'Task']);

Router::addRoutes('^$', ['controller' => 'HomePage', 'action' => 'index']);

Router::addRoutes('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$'); 

Router::dispatch($query);

