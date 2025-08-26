<?php
$host     = "localhost";
$username = "root";
$password = "";
$database = "escoladb";

try {
    $conectar = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);
    $conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Conectado com sucesso!";
} catch (PDOException $e) {
    echo "Falha na conexão: " . $e->getMessage();
}
?>
