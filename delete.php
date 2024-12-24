<?php
// Incluímos a conexão com o banco de dados
require_once __DIR__ . '/config/db.php';

// Verificamos se recebemos o ID via GET
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    try {
        // Preparamos a query de exclusão
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    } catch (PDOException $e) {
        die("Erro ao excluir usuário: " . $e->getMessage());
    }
}

// Após a exclusão, podemos redirecionar de volta para a listagem
header("Location: read.php");
exit;

?>
<?php
/*
  --- RECOMENDAÇÃO DE MELHORIA (COMENTÁRIO GRANDE) ---

  - Poderíamos implementar um sistema de "exclusão lógica" (is_active = 0, por exemplo), para evitar
    perder completamente os dados do usuário no banco (caso seja necessário histórico).
  - Implementar permissão de acesso, para que apenas usuários específicos (ex: administradores)
    possam excluir.
  - Para evitar exclusões acidentais ou mal-intencionadas, poderíamos usar tokens (CSRF) e uma
    confirmação prévia em um formulário, em vez de apenas um link GET.
  - Em um projeto mais complexo, poderíamos ter logs de auditoria, registrando quem excluiu o usuário,
    quando, e qual era o estado anterior.
*/
