<?php

declare(strict_types=1);

namespace T0mmy742\PHPTutorial\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function is_array;
use function is_string;
use function trim;

class TrimMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $params = $request->getParsedBody();
        if (is_array($params)) {
            foreach ($params as $key => $value) {
                $params[$key] = is_string($value) ? trim($value) : $value;
            }
            $request = $request->withParsedBody($params);
        }
        return $handler->handle($request);
    }
}
