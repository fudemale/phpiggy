<?php

declare(strict_types=1);

require __DIR__ . "/../../vendor/autoload.php";

use Framework\App;

use App\Config\Paths;

// use App\Controllers\{HomeController, AboutController};
use function App\Config\registerRoutes;
// HomeController::class;
// AboutController::class;

$app = new App(Paths::SOURCE . "/App/container-definitions.php");


registerRoutes($app);
// $app->get('/', [HomeController::class, 'home']);
// $app->get('/about', [AboutController::class, 'about']);
return $app;
