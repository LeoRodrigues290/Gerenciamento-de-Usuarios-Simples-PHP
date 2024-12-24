<?php
require_once __DIR__ . '/config/db.php';

$mensagemSucesso = "";
$mensagemErro    = "";

// Verificamos se o ID foi passado via GET
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome  = $_POST['nome']  ?? null;
        $email = $_POST['email'] ?? null;

        if (!empty($nome) && !empty($email)) {
            try {
                $sql = "UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':nome'  => $nome,
                    ':email' => $email,
                    ':id'    => $id
                ]);
                $mensagemSucesso = "Usuário atualizado com sucesso!";
            } catch (PDOException $e) {
                $mensagemErro = "Erro ao atualizar usuário: " . $e->getMessage();
            }
        } else {
            $mensagemErro = "Por favor, preencha todos os campos.";
        }
    }

    // Buscamos novamente os dados do usuário
    try {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            $mensagemErro = "Usuário não encontrado.";
        }
    } catch (PDOException $e) {
        die("Erro ao buscar dados do usuário: " . $e->getMessage());
    }
} else {
    header("Location: read.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Usuário</title>
    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h1 class="mb-4">Atualizar Usuário</h1>

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

    <?php if (!empty($usuario)): ?>
        <form action="update.php?id=<?php echo $usuario['id']; ?>" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input
                        type="text"
                        name="nome"
                        id="nome"
                        class="form-control"
                        value="<?php echo htmlspecialchars($usuario['nome']); ?>"
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
                        value="<?php echo htmlspecialchars($usuario['email']); ?>"
                        required
                >
            </div>

            <button type="submit" class="btn btn-warning">Atualizar</button>
            <a href="read.php" class="btn btn-secondary">Voltar</a>
        </form>
    <?php endif; ?>
</div>

<!-- Bootstrap JS + Popper (CDN) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
/*
  --- RECOMENDAÇÃO DE MELHORIA (COMENTÁRIO GRANDE) ---
  - Num projeto MVC, teríamos um método "update" em um "controller" e a lógica de busca/atualização
    em um "model" (ex: UsuarioModel).
  - Podemos implementar validações de dados específicas, como filter_var($email, FILTER_VALIDATE_EMAIL).
  - Poderíamos tratar a situação de "usuário não encontrado" de forma mais amigável, com redirecionamento.
  - Em caso de sucesso, poderíamos redirecionar para a listagem, evitando reenvio de dados.
  - Em sistemas mais complexos, poderíamos registrar logs de auditoria para cada atualização.
*/
?>
