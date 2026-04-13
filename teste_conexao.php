<?php
header('Content-Type: application/json');

$host    = "localhost";
$dbname  = "gradly";
$usuario = "root";
$senha   = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Verificar se as tabelas existem
    $tabelas = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    
    echo json_encode([
        "status" => "sucesso",
        "mensagem" => "Conexão OK!",
        "tabelas" => $tabelas
    ]);
} catch (PDOException $e) {
    echo json_encode([
        "status" => "erro",
        "mensagem" => $e->getMessage()
    ]);
}