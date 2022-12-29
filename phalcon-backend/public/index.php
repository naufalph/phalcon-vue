<?php
declare(strict_types=1);

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Micro;

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {

  $di = new FactoryDefault();

  include APP_PATH . '/config/services.php';  

  $config = $di->getConfig();

  include APP_PATH . '/config/loader.php';

  $app = new Micro($di); 

  include APP_PATH . '/app.php'; //bener

  $app->handle($_SERVER['REQUEST_URI']);
} catch (\Exception $e) {
  echo $e->getMessage() . '<br>';
  echo '<pre>' . $e->getTraceAsString() . '</pre>';
}