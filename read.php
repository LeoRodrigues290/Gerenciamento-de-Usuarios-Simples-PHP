<?php
// Incluímos a conexão com o banco de dados
require_once __DIR__ . '/config/db.php';

// Tentamos obter todos os usuários do banco
try {
    $sql = "SELECT * FROM usuarios ORDER BY id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    // Armazenamos em uma variável para exibir no HTML abaixo
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
    </head>
    <body>
    <h1>Lista de Usuários</h1>

    <?php if (!empty($usuarios)): ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
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
                        <!-- Link para atualizar -->
                        <a href="update.php?id=<?php echo $usuario['id']; ?>">Editar</a> |
                        <!-- Link para deletar -->
                        <a href="delete.php?id=<?php echo $usuario['id']; ?>"
                           onclick="return confirm('Tem certeza que deseja excluir este usuário?');">
                            Excluir
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum usuário encontrado.</p>
    <?php endif; ?>

    <p><a href="create.php">Criar Novo Usuário</a></p>
    <p><a href="index.php">Voltar para a página inicial</a></p>
    </body>
    </html>

<?php
/*
  --- RECOMENDAÇÃO DE MELHORIA (COMENTÁRIO GRANDE) ---

  - Em uma aplicação maior, essa listagem ficaria em uma camada de "View" (separada do Controller),
    e a parte de buscar os usuários ficaria em um "Model" (Classe Usuario, por exemplo).
  - Poderíamos adicionar paginação, para não carregar uma lista enorme de usuários de uma só vez.
  - Para segurança, podemos implementar um sistema de autenticação para que apenas usuários
    logados visualizem a lista de usuários (evita exposição de dados).
  - O uso de htmlspecialchars() é importante para evitar ataques XSS, mas podemos reforçar a sanitização,
    por exemplo, com uso de filter_var ao exibir dados.
  - Podemos pensar em ter um layout padrão de cabeçalho e rodapé para todas as páginas, facilitando
    a manutenção e a consistência do design.
*/
