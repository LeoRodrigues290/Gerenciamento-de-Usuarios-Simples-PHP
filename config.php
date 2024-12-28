<?php
// Conexão segura com o banco de dados usando PDO.
$host = 'localhost'; // Endereço do servidor.
$db = 'SimplePHP'; // Nome do banco.
$user = 'root'; // Usuário do banco.
$pass = ''; // Senha do banco.

try {
    // Conecta ao banco de dados usando PDO.
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Configura para exibir erros do banco.
} catch (PDOException $e) {
    die("Erro ao conectar: " . $e->getMessage()); // Interrompe em caso de erro.
}
?>
