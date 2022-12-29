<?php

/**
 * Registering an autoloader
 */
$loader = new \Phalcon\Loader();

$loader->registerNamespaces(
  [
    'MyApp\Models' => $config->application->modelsDir
  ]
);

$loader->register();