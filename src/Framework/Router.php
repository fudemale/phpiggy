<?php

declare(strict_types=1);

namespace Framework;

class Router
{
    private array $routes = [];

    private array $middlewares = [];

    public function add(string $method, string $path, array $controller)
    {


        $path = $this->normalizePath($path);
        $this->routes[] = [
            'path' => $path,
            'method' => strtoupper($method),
            // to keep the consistent paths^
            'controller' => $controller,
            'middlewares' => []
        ];
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path, '/');
        $path = "/{$path}/";
        $path = preg_replace('#[/]{2,}#', '/', $path);
        // to avoid unexpected path so using these functions
        return $path;
    }

    public function dispatch(string $path, string $method, Container $container = null)
    {
        $path = $this->normalizePath($path);
        $method = strtoupper($method);
        // echo $path . $method;
        foreach ($this->routes as $route) {
            if (!preg_match("#^{$route['path']}$#", $path) || $route['method'] !== $method)
            // ^ the carrot ch checks if the value begins with the pattern & $ checks if the value ends with the patern & both # delimeter indicates start and end
            // if(route['path]!==$path) also works but it doesn't check the parameters for future
            {
                continue;
            }
            // echo 'route found';
            [$class, $function] = $route['controller'];
            // controller item is an array storing class name & method name
            $controllerInstance = $container ? $container->resolve($class) : new $class;
            // ^ it's ok to provide a string after new keyword as string points to a class with ns as we're instantiating controllerinstance
            $action = fn() => $controllerInstance->{$function}();
            // it's acceptable to type a string after -> PHP resolves the value in string to a method in class
            $allMiddleware = [...$route['middlewares'], ...$this->middlewares];

            foreach ($allMiddleware as $middleware) {
                $middlewareInstance = $container ? $container->resolve($middleware) :  new $middleware;
                $action = fn() => $middlewareInstance->process($action);
            }

            $action();

            return;
        }
    }



    public function addMiddleware(string $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function addRouteMiddleware(string $middleware)
    {
        $lastRouteKey = array_key_last($this->routes);
        $this->routes[$lastRouteKey]['middlewares'][] = $middleware;
    }
    //^ Routes are required to display data from server to browser so using dispatch fn here
}
