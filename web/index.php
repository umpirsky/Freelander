<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../vendor/mailchimp/mailchimp/src/Mailchimp/Exceptions.php';

$app = new Silex\Application();

require __DIR__.'/../src/app.php';
require __DIR__.'/../src/controllers.php';

$app->run();
