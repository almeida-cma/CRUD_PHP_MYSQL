<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_db";
$port = 7306; // Porta específica para o MySQL

// Conexão com a porta especificada
$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
