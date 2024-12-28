<?php
// Inicia a sessão.
session_start();
// Verifica se o usuário está logado.
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php'); // Redireciona para o login se não estiver logado.
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Importa o Bootstrap via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
<div class="card p-4 shadow text-center" style="width: 300px;">
    <h3>Bem-vindo!</h3>
    <p>Você está logado.</p>
    <a href="logout.php" class="btn btn-danger w-100">Sair</a>
</div>
</body>
</html>
