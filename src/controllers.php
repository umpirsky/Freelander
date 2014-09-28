<?php

$app->get('/{theme}', function(Silex\Application $app, $theme) {
    return $app['twig']->render(
        ($theme ? $theme : $app['theme'])
        .'/index.html'
    );
})->value('theme', null)->bind('home');

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
