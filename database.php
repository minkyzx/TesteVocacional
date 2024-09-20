<?php
// Arquivo database.php

$host = 'localhost';
$db = 'teste_vocacional';
$user = 'root';
$pass = '';

// Conexão com o banco de dados usando PDO
try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
    exit();
}
?>
