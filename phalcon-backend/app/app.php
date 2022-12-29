<?php

/**
 * Local variables
 * @var \Phalcon\Mvc\Micro $app
 */

/**
 * Add your routes here
 */
$app->get('/', function () {
    echo $this['view']->render('index');
});

$app->get(
    '/patients/{id:[0-9]+}',
    function ($id) {
    }
);

$app->post(
    '/patients',
    function () {
    }
);

$app->put(
    '/patients/{id:[0-9]+}',
    function ($id) {
    }
);

$app->delete(
    '/patients/{id:[0-9]+}',
    function ($id) {
    }
);


/**
 * Not found handler
 */
$app->notFound(function () use($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo $app['view']->render('404');
});
