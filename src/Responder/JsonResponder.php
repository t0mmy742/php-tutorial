<?php

declare(strict_types=1);

namespace T0mmy742\PHPTutorial\Responder;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use RuntimeException;

use function json_encode;
use function json_last_error;
use function json_last_error_msg;

class JsonResponder
{
    private StreamFactoryInterface $streamFactory;

    public function __construct(StreamFactoryInterface $streamFactory)
    {
        $this->streamFactory = $streamFactory;
    }

    /**
     * @param ResponseInterface $response
     * @param array<string, mixed> $data
     * @param int|null $status
     * @return ResponseInterface
     */
    public function json(ResponseInterface $response, array $data, ?int $status = null): ResponseInterface
    {
        $json = (string) json_encode($data);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new RuntimeException(json_last_error_msg(), json_last_error());
        }

        $response = $response
            ->withHeader('Content-Type', 'application/json')
            ->withBody($this->streamFactory->createStream($json));

        if ($status !== null) {
            $response = $response->withStatus($status);
        }

        return $response;
    }
}
