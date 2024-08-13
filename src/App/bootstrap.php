<?php

declare(strict_types=1);

require __DIR__ . "/../../vendor/autoload.php";

use Framework\App;

use App\Config\Paths;
use Dotenv\Dotenv;

// use App\Controllers\{HomeController, AboutController};
use function App\Config\{registerRoutes, registerMiddleware};
// HomeController::class;
// AboutController::class;
$dotenv = Dotenv::createImmutable(Paths::ROOT);
$dotenv->load();
// creates instance of dot env class
$app = new App(Paths::SOURCE . "/App/container-definitions.php");


registerRoutes($app);
registerMiddleware($app);
// $app->get('/', [HomeController::class, 'home']);
// $app->get('/about', [AboutController::class, 'about']);
return $app;
