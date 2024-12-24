<?php
require_once __DIR__ . '/config/db.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    try {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    } catch (PDOException $e) {
        die("Erro ao excluir usuário: " . $e->getMessage());
    }
}

header("Location: read.php");
exit;

?>
<?php
/*
  --- RECOMENDAÇÃO DE MELHORIA (COMENTÁRIO GRANDE) ---
  - Poderíamos implementar uma "exclusão lógica" (is_active = 0) em vez de remover do banco.
  - Permissões de acesso (apenas quem tem permissão pode excluir).
  - Uso de tokens CSRF para evitar ataques de "falsificação de requisição".
  - Logs de auditoria para saber quem excluiu o usuário, quando, e qual era o estado anterior.
*/
?>
