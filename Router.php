<?php

class Router {
    private $routes = [];

    public function add($method, $path, $handler) {
        $this->routes[] = ['method' => $method, 'path' => $path, 'handler' => $handler];
    }

    public function dispatch($requestedPath) {
        $method = $_SERVER['REQUEST_METHOD'];
        echo "Requested Method: $method\n";
        echo "Requested Path: $requestedPath\n";
    
        foreach ($this->routes as $route) {
            if ($method === $route['method'] && preg_match($this->convertToRegex($route['path']), $requestedPath, $matches)) {
                array_shift($matches); 
                return call_user_func_array($route['handler'], $matches);
            }
        }
        http_response_code(404);
        echo json_encode(["message" => "Página não encontrada."]);
    }
    
    
    private function convertToRegex($path) {
        $path = preg_replace('/\{(\w+)\}/', '([^/]+)', $path);
        return '#^' . $path . '$#';
    }
    
}

