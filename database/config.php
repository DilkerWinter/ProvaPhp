<?php
header('Content-Type: application/json');

$host = "localhost";
$port = "5432";
$dbname = "phpprova";
$user = "postgres";
$password = "123";

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo json_encode(['success' => true, 'message' => 'Conexão realizada com sucesso!']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Erro na conexão: ' . $e->getMessage()]);
}
