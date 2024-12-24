<?php
require_once __DIR__ . '/config/db.php';

try {
    $sql = "SELECT * FROM usuarios ORDER BY id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar usuários: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listar Usuários</title>
    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h1 class="mb-4">Lista de Usuários</h1>

    <?php if (!empty($usuarios)): ?>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Criado em</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?php echo $usuario['id']; ?></td>
                    <td><?php echo htmlspecialchars($usuario['nome']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                    <td><?php echo $usuario['created_at']; ?></td>
                    <td>
                        <a
                                href="update.php?id=<?php echo $usuario['id']; ?>"
                                class="btn btn-sm btn-warning"
                        >Editar</a>
                        <a
                                href="delete.php?id=<?php echo $usuario['id']; ?>"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Tem certeza que deseja excluir este usuário?');"
                        >Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">
            Nenhum usuário encontrado.
        </div>
    <?php endif; ?>

    <a href="create.php" class="btn btn-primary">Criar Novo Usuário</a>
    <a href="index.php" class="btn btn-secondary">Voltar para a página inicial</a>
</div>

<!-- Bootstrap JS + Popper (CDN) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
/*
  --- RECOMENDAÇÃO DE MELHORIA (COMENTÁRIO GRANDE) ---
  - Em uma aplicação maior, essa listagem ficaria em uma "View" e a parte de buscar os usuários
    ficaria em um "Model" (ex: UsuarioModel).
  - Poderíamos adicionar paginação para não carregar uma lista enorme de usuários de uma só vez.
  - Podemos implementar um sistema de autenticação para restringir acesso.
  - O uso de htmlspecialchars() é importante para evitar XSS, mas podemos reforçar a sanitização.
  - Poderíamos ter um layout padrão de cabeçalho e rodapé para todas as páginas.
*/
?>
