<?php

declare(strict_types=1);

namespace T0mmy742\PHPTutorial\Error\Renderers;

use Slim\Error\Renderers\HtmlErrorRenderer;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;
use Throwable;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class CustomHtmlErrorRenderer extends HtmlErrorRenderer
{
    private Twig $twig;

    public function __construct(Twig $twig)
    {
        $this->twig = $twig;
    }

    /**
     * Custom HTML error renderer for some Exception
     * @see HttpNotFoundException
     *
     * {@inheritDoc}
     */
    public function __invoke(Throwable $exception, bool $displayErrorDetails): string
    {
        try {
            if ($exception instanceof HttpNotFoundException) {
                $data = [];
                $data['title'] = 'Error 404';
                return $this->twig->fetch('errors/404.html.twig', $data);
            } else {
                return parent::__invoke($exception, $displayErrorDetails);
            }
        } catch (LoaderError | RuntimeError | SyntaxError $e) {
            return parent::__invoke($exception, $displayErrorDetails);
        }
    }
}
