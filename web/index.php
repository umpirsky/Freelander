<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app->register(new Igorw\Silex\ConfigServiceProvider(__DIR__.'/../config.json'));

$app->get('/', function() {
    return 'Hello Freelander!';
});

$app->run();
