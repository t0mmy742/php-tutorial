<?php

declare(strict_types=1);

namespace T0mmy742\PHPTutorial\Responder;

use Psr\Http\Message\ResponseInterface;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class TwigResponder
{
    private Twig $twig;

    public function __construct(Twig $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param ResponseInterface $response
     * @param string $title
     * @param string $template
     * @param array<string, mixed> $data
     * @return ResponseInterface
     */
    public function render(
        ResponseInterface $response,
        string $title,
        string $template,
        array $data = []
    ): ResponseInterface {
        $data['title'] = $title;
        try {
            return $this->twig->render($response, $template, $data);
        } catch (LoaderError | RuntimeError | SyntaxError $e) {
            // Debugging only
            var_dump($e->getMessage());
            $response->getBody()->write('<br><br><br>');
            $response->getBody()->write('Erreur lors du chargement de la page.');
            return $response->withStatus(500);
        }
    }
}
