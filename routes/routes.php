<?php
require 'database/config.php';
require 'controller/LivroController.php';
require 'service/LivroService.php';
require 'model/Livro.php';

use service\LivroService;
use controller\LivroController;

global $con;
if (!$con) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao conectar com o banco de dados']);
    exit();
}

$livroService = new LivroService($con);
$controller = new LivroController($livroService);

$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
    case 'GET':
        $controller->getAllLivros();
        break;

    case 'POST':
        $controller->createLivro();
        break;

    default:
        http_response_code(405);
        echo json_encode(['message' => 'Method Not Allowed']);
        break;
}
