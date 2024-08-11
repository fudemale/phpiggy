<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\TemplateEngine;

class FlashMiddleware implements MiddlewareInterface
{
    public function __construct(private TemplateEngine $view) {}


    public function process(callable $next)
    {
        $this->view->addGlobal('errors', $_SESSION['errors'] ?? []);
        // this is global data and ^ method above for adding errors for all
        unset($_SESSION['errors']);
        // destroy variable or items in an array ^

        $this->view->addGlobal('oldFormData', $_SESSION['oldFormData'] ?? []);

        unset($_SESSION['oldFormData']);

        $next();
    }
}
