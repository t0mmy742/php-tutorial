<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Views\Twig;

return function (ResponseFactoryInterface $responseFactory): array {
    return [
        PDO::class => function (ContainerInterface $container) {
            $dbSettings = $container->get('settings')['db'];

            /* For demonstration only, we are using memory database.
            return new PDO(
                'mysql:host='
                . $dbSettings['host']
                . ';dbname='
                . $dbSettings['database']
                . ';charset='
                . $dbSettings['charset'],
                $dbSettings['username'],
                $dbSettings['password']
            );
            */
            return new PDO('sqlite::memory:');
        },
        'view' => DI\factory(function (ContainerInterface $container) {
            return Twig::create(__DIR__ . '/../ressources/views');
        }),
        Twig::class => function (ContainerInterface $container) {
            return $container->get('view');
        },

        // Following is to facilitate autowiring
        StreamFactoryInterface::class => DI\autowire(StreamFactory::class),
        ResponseFactoryInterface::class => $responseFactory,
    ];
};
