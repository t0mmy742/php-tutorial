<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

session_start([
    'cookie_httponly' => true,
    'cookie_samesite' => 'Strict'
]);

require __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

$settings = require __DIR__ . '/settings.php';
$containerBuilder->addDefinitions($settings());

$responseFactory = AppFactory::determineResponseFactory();

$dependencies = require __DIR__ . '/dependencies.php';
$containerBuilder->addDefinitions($dependencies($responseFactory));

$container = $containerBuilder->build();

AppFactory::setContainer($container);
AppFactory::setResponseFactory($responseFactory);
$app = AppFactory::create();

$middleware = require __DIR__ . '/middleware.php';
$middleware($app);

$routes = require __DIR__ . '/routes.php';
$routes($app);

$app->run();
