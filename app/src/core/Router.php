<?php

namespace App\core;

use AltoRouter;
use Exception;

class Router
{
    private AltoRouter $router;
    private string $controllerNamespace = 'App\\controller';
    private array $middlewares = []; // middlewares par route
    private array $globalMiddlewares = [];

    public function __construct()
    {
        $this->router = new AltoRouter();
    }

    // Routes
    public function get(string $route, string $target, string $name)
    {
        $this->router->map('GET', $route, $target, $name);
    }

    public function post(string $route, string $target, string $name)
    {
        $this->router->map('POST', $route, $target, $name);
    }

    public function delete(string $route, string $target, string $name)
    {
        $this->router->map('DELETE', $route, $target, $name);
    }

    public function any(string $route, string $target, string $name)
    {
        $this->router->map('GET|POST', $route, $target, $name);
    }

    // Middlewares globaux
    public function use(string $middlewareClass)
    {
        $this->globalMiddlewares[] = $middlewareClass;
    }

    // Middleware par route
    public function middleware(string $routeName, $middleware)
    {
        $this->middlewares[$routeName][] = $middleware;
    }

    // Groupe de routes
    public function groupMiddleware(array $routeNames, array $middlewares)
    {
        foreach ($routeNames as $routeName) {
            foreach ($middlewares as $middleware) {
                $this->middleware($routeName, $middleware);
            }
        }
    }

    // Dispatcher
    public function dispatch()
    {
        $match = $this->router->match();

        if (!$match) {
            http_response_code(404);
            throw new Exception("Aucune route ne correspond.");
        }

        $routeName = $match['name'] ?? null;

        // 1. Middlewares globaux
        foreach ($this->globalMiddlewares as $mw) {
            $this->runMiddleware($mw);
        }

        // 2. Middlewares de la route
        if ($routeName && isset($this->middlewares[$routeName])) {
            foreach ($this->middlewares[$routeName] as $mw) {
                $this->runMiddleware($mw);
            }
        }

        // 3. Contrôleur
        list($controllerName, $method) = explode('#', $match['target']);
        $controllerClass = $this->controllerNamespace . '\\' . $controllerName;

        if (!class_exists($controllerClass)) {
            throw new Exception("Contrôleur $controllerClass introuvable.");
        }

        $controller = new $controllerClass();

        if (!method_exists($controller, $method)) {
            throw new Exception("Méthode $method introuvable dans $controllerClass.");
        }

        $response = call_user_func_array([$controller, $method], $match['params']);

        if (is_array($response) || is_object($response)) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
        } elseif (is_string($response)) {
            echo $response;
        } elseif ($response !== null) {
            echo $response;
        }
    }

    private function runMiddleware($middleware): void
    {
        // Si callable, instancie
        if (is_callable($middleware)) {
            $middleware = $middleware(); // ex: new RoleMiddleware(['admin'])
        }
        // Si string, instancie
        elseif (is_string($middleware) && class_exists($middleware)) {
            $middleware = new $middleware();
        }

        if (!$middleware instanceof MiddlewareInterface) {
            throw new Exception("Le middleware doit implémenter MiddlewareInterface.");
        }

        if ($middleware->handle() === false) {
            exit; // Stoppe si refus
        }
    }

    // URL / redirection
    public function generate(string $routeName, array $params = []): ?string
    {
        return $this->router->generate($routeName, $params);
    }

    public function redirect(string $url)
    {
        header("Location: $url");
        exit();
    }
}
