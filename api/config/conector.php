<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'sist_estoque';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    
    /* echo "Conexão bem-sucedida!"; */
} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
}