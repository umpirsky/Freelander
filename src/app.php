<?php

$app->register(new Igorw\Silex\ConfigServiceProvider(
    __DIR__.'/../config.json'
));

$app->register(new Silex\Provider\SessionServiceProvider());

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

$app->register(new Silex\Provider\TwigServiceProvider(), [
    'twig.path' => [
        __DIR__.'/../views',
        __DIR__.'/../web/themes',
    ]
]);

$app->register(new SilexMailchimp\Provider\MailchimpServiceProvider());

$app->register(new Bt51\Silex\Provider\GoogleAnalyticsServiceProvider\GoogleAnalyticsServiceProvider());
