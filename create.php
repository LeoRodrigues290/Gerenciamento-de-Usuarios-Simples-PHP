<?php
require_once __DIR__ . '/config/db.php';

$mensagemSucesso = "";
$mensagemErro    = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome  = $_POST['nome']  ?? null;
    $email = $_POST['email'] ?? null;

    if (!empty($nome) && !empty($email)) {
        try {
            $sql = "INSERT INTO usuarios (nome, email) VALUES (:nome, :email)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nome'  => $nome,
                ':email' => $email
            ]);
            $mensagemSucesso = "Usuário criado com sucesso!";
        } catch (PDOException $e) {
            $mensagemErro = "Erro ao criar usuário: " . $e->getMessage();
        }
    } else {
        $mensagemErro = "Por favor, preencha todos os campos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Criar Usuário</title>
    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h1 class="mb-4">Criar Usuário</h1>

    <?php if(!empty($mensagemSucesso)): ?>
        <div class="alert alert-success">
            <?php echo $mensagemSucesso; ?>
        </div>
    <?php endif; ?>

    <?php if(!empty($mensagemErro)): ?>
        <div class="alert alert-danger">
            <?php echo $mensagemErro; ?>
        </div>
    <?php endif; ?>

    <form action="create.php" method="POST" class="mb-3">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input
                    type="text"
                    name="nome"
                    id="nome"
                    class="form-control"
                    required
            >
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input
                    type="email"
                    name="email"
                    id="email"
                    class="form-control"
                    required
            >
        </div>

        <button type="submit" class="btn btn-primary">Criar</button>
        <a href="index.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>

<!-- Bootstrap JS + Popper (CDN) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
/*
  --- RECOMENDAÇÃO DE MELHORIA (COMENTÁRIO GRANDE) ---
  - Em um projeto mais robusto, separaríamos a lógica de negócio (inserir no banco)
    da exibição (HTML) em arquivos diferentes (padrão MVC).
  - Utilizaríamos validações mais avançadas (ex: filter_var no email).
  - Implementaríamos um token CSRF para garantir que o formulário só seja submetido
    pelo nosso site.
  - Em vez de imprimir o erro diretamente na tela, poderíamos usar um sistema de log.
  - Poderíamos usar redirecionamentos para outra página após criar, evitando reenvio do form.
  - Outro ponto: reuso de layout (cabeçalho/rodapé) para ter consistência visual.
*/
?>
