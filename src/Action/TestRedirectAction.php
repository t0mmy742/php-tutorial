<?php

declare(strict_types=1);

namespace T0mmy742\PHPTutorial\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use T0mmy742\PHPTutorial\Responder\JsonResponder;
use T0mmy742\PHPTutorial\Responder\RedirectResponder;

class TestRedirectAction
{
    private RedirectResponder $redirectResponder;

    public function __construct(RedirectResponder $redirectResponder)
    {
        $this->redirectResponder = $redirectResponder;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->redirectResponder->redirect($response, '/');
    }
}
