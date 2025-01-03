<?php
// Inicia a sessão.
session_start();
// Inclui a configuração do banco de dados.
require 'config.php';

// Verifica se o formulário foi enviado.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email']; // Recebe o email do formulário.
    $senha = $_POST['senha']; // Recebe a senha do formulário.

    // Consulta o usuário pelo email.
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->bindValue(':email', $email); // Substitui ":email" pelo valor de $email.
    $stmt->execute(); // Executa a consulta.
    $user = $stmt->fetch(PDO::FETCH_ASSOC); // Busca o resultado como array associativo.

    // Verifica se o usuário existe e se a senha está correta.
    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['user_id'] = $user['id']; // Salva o ID do usuário na sessão.
        header('Location: dashboard.php'); // Redireciona para a dashboard.
        exit;
    } else {
        $error = "Credenciais inválidas."; // Mensagem de erro.
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Importa o Bootstrap via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
<div class="card p-5" style="width: 300px;">
    <h3 class="text-center">Login</h3>
    <!-- Exibe erro se houver -->
    <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <!-- Formulário de login -->
    <form method="POST">
        <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <input type="password" name="senha" class="form-control" placeholder="Senha" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Entrar</button>
    </form>
    <a href="registrar.php" class="d-block text-center mt-3">Registrar-se</a>
</div>
</body>
</html>
