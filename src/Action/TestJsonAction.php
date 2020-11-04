<?php

declare(strict_types=1);

namespace T0mmy742\PHPTutorial\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use T0mmy742\PHPTutorial\Model\Model;
use T0mmy742\PHPTutorial\Responder\JsonResponder;

class TestJsonAction
{
    private JsonResponder $jsonResponder;
    private Model $model;

    public function __construct(JsonResponder $jsonResponder, Model $model)
    {
        $this->jsonResponder = $jsonResponder;
        $this->model = $model;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->jsonResponder->json($response, [
            'message' => 'My message',
            'data' => $this->model->getData()
        ]);
    }
}
