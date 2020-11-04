<?php

declare(strict_types=1);

use Slim\App;
use Slim\Views\TwigMiddleware;
use T0mmy742\PHPTutorial\Error\Renderers\CustomHtmlErrorRenderer;
use T0mmy742\PHPTutorial\Middleware\TrimMiddleware;
use t0mmy742\Middleware\TrailingSlashMiddleware;

return function (App $app) {
    $app->add(TwigMiddleware::createFromContainer($app));
    $app->add(new TrimMiddleware());
    $app->addRoutingMiddleware();
    $errorMiddleware = $app->addErrorMiddleware(true, true, true);
    $errorMiddleware->getDefaultErrorHandler()->registerErrorRenderer(
        'text/html',
        CustomHtmlErrorRenderer::class
    );
    $app->add(new TrailingSlashMiddleware($app->getResponseFactory()));
};
