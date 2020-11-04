<?php

declare(strict_types=1);

namespace T0mmy742\PHPTutorial\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use T0mmy742\PHPTutorial\Responder\JsonResponder;
use T0mmy742\PHPTutorial\Responder\TwigResponder;

class TestTwigAction
{
    private TwigResponder $twigResponder;

    public function __construct(TwigResponder $twigResponder)
    {
        $this->twigResponder = $twigResponder;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->twigResponder->render($response, 'Test view', 'test.html.twig', [
            'foo' => 'var'
        ]);
    }
}
