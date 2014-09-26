<?php

require_once __DIR__.'/../vendor/autoload.php';

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

$app->get('/', function() use ($app) {
    return $app['twig']->render('default/index.html');
})->bind('home');

$app->post('/subscribe', function(Symfony\Component\HttpFoundation\Request $request) use ($app) {
    $app['mailchimp']->lists->subscribe($app['mailchimp.list.id'], array('email' => $request->get('email')));

    $app['session']->getFlashBag()->add('message', 'Thanks for subscribing.');

    return $app->redirect($app['url_generator']->generate('home'));
})->bind('subscribe');

$app->run();
