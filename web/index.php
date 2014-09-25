<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app->register(new Igorw\Silex\ConfigServiceProvider(
    __DIR__.'/../config.json'
));
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/themes',
));

$app->get('/', function() use ($app) {
    return $app['twig']->render('default/index.html');
});

$app->run();
