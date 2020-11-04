<?php

declare(strict_types=1);

use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use T0mmy742\PHPTutorial\Action\TestJsonAction;
use T0mmy742\PHPTutorial\Action\TestRedirectAction;
use T0mmy742\PHPTutorial\Action\TestTwigAction;

return function (App $app) {
    $app->group('', function (RouteCollectorProxy $group) {
        $group
            ->get('/', TestTwigAction::class);
        $group
            ->get('/json', TestJsonAction::class);
        $group
            ->get('/redirect', TestRedirectAction::class);
    });
};
