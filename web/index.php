<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../vendor/mailchimp/mailchimp/src/Mailchimp/Exceptions.php';

$app = new Silex\Application();

$app->register(new Igorw\Silex\ConfigServiceProvider(
    __DIR__.'/../config.json'
));

$app->register(new Silex\Provider\SessionServiceProvider());

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

$app->register(new Silex\Provider\TwigServiceProvider(), [
    'twig.path' => __DIR__.'/themes',
]);

$app->register(new SilexMailchimp\Provider\MailchimpServiceProvider());

$app->register(new Bt51\Silex\Provider\GoogleAnalyticsServiceProvider\GoogleAnalyticsServiceProvider());

$app->get('/', function() use ($app) {
    return $app['twig']->render('default/index.html');
})->bind('home');

$app->post('/subscribe', function(Symfony\Component\HttpFoundation\Request $request) use ($app) {
    $app['mailchimp']->lists->subscribe($app['mailchimp.list.id'], array('email' => $request->get('email')));

    $app['session']->getFlashBag()->add('success', 'Thanks for subscribing.');

    return $app->redirect($app['url_generator']->generate('home'));
})->bind('subscribe');

$errorHandler = function ($e) use ($app) {
    $app['session']->getFlashBag()->add('danger', $e->getMessage());

    return $app->redirect($app['url_generator']->generate('home'));
};

$app->error(function (Mailchimp_ValidationError $e) use ($errorHandler) {
    return $errorHandler($e);
});

$app->error(function (Mailchimp_List_AlreadySubscribed $e) use ($errorHandler) {
    return $errorHandler($e);
});

$app->run();
