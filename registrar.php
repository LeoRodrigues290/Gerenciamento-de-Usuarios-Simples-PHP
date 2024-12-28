<?php
// Inclui a configuração do banco de dados.
require 'config.php';

// Verifica se o formulário foi enviado.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email']; // Recebe o email do formulário.
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografa a senha.

    // Insere um novo usuário no banco de dados.
    $stmt = $pdo->prepare("INSERT INTO usuarios (email, senha) VALUES (:email, :senha)");
    $stmt->bindValue(':email', $email); // Substitui ":email" pelo valor de $email.
    $stmt->bindValue(':senha', $senha); // Substitui ":senha" pela senha criptografada.
    if ($stmt->execute()) { // Executa a inserção.
        header('Location: index.php'); // Redireciona para o login.
        exit;
    } else {
        $error = "Erro ao registrar."; // Mensagem de erro.
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <!-- Importa o Bootstrap via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
<div class="card p-5">
    <h3 class="text-center">Registrar</h3>
    <!-- Exibe erro se houver -->
    <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <!-- Formulário de registro -->
    <form method="POST">
        <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <input type="password" name="senha" class="form-control" placeholder="Senha" required>
        </div>
        <button type="submit" class="btn btn-success w-100">Registrar</button>
    </form>
    <a href="index.php" class="d-block text-center mt-3">Voltar</a>
</div>
</body>
</html>
