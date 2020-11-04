<?php

declare(strict_types=1);

namespace T0mmy742\PHPTutorial\Responder;

use Psr\Http\Message\ResponseInterface;

class RedirectResponder
{
    public function redirect(ResponseInterface $response, string $url): ResponseInterface
    {
        return $response->withHeader('Location', $url)->withStatus(302);
    }
}
