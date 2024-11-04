<?php
$host = "localhost";
$port = "5432"; 
$dbname = "phpprova";
$user = "postgres";
$password = "123"; 

$conn_string = "host=$host port=$port dbname=$dbname user=$user password=$password";

$con = pg_connect($conn_string);

if (!$con) {
    echo "Erro na conexão com o banco de dados.";
} else {
    echo "Conexão realizada com sucesso!";
}

?>
