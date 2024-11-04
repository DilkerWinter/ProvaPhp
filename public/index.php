<?php
require_once '../config/config.php';
require_once '../controller/LivroController.php';
require_once '../Router.php';

header("Content-type: application/json; charset=UTF-8");

$router = new Router();
$controller = new LivroController($pdo);

$router->add('GET', '/livro', [$controller, 'list']);
$router->add('POST', '/livro', [$controller, 'create']);
$router->add('DELETE', '/livro/{id}', [$controller, 'delete']);
$router->add('PUT', '/livro/{id}', [$controller, 'update']);

$requestedPath = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$pathItems = explode("/", trim($requestedPath, "/"));

if (isset($pathItems[0]) && $pathItems[0] === 'livro') {
    $requestedPath = '/livro';

    if (isset($pathItems[1]) && $pathItems[1] !== "") {
        $requestedPath .= '/' . $pathItems[1];
    }

    $router->dispatch($requestedPath);
} else {
    http_response_code(404);
    echo json_encode(["message" => "Página não encontrada."]);
}
