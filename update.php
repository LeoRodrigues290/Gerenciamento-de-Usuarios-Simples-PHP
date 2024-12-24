<?php
// Incluímos a conexão com o banco de dados
require_once __DIR__ . '/config/db.php';

// Inicializa variáveis para mensagens
$mensagemSucesso = "";
$mensagemErro    = "";

// Verificamos se o ID foi passado via GET
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Se o formulário foi enviado (método POST)
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

    // Após atualizar (ou se estivermos apenas abrindo a página),
    // buscamos novamente os dados do usuário para preencher no formulário
    try {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        // Se não encontrar o usuário, redireciona ou exibe mensagem de erro
        if (!$usuario) {
            $mensagemErro = "Usuário não encontrado.";
        }
    } catch (PDOException $e) {
        die("Erro ao buscar dados do usuário: " . $e->getMessage());
    }
} else {
    // Se não receber ID, podemos redirecionar para a listagem ou exibir um erro
    header("Location: read.php");
    exit;
}
?>

    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>Atualizar Usuário</title>
    </head>
    <body>
    <h1>Atualizar Usuário</h1>

    <?php if(!empty($mensagemSucesso)): ?>
        <p style="color: green;"><?php echo $mensagemSucesso; ?></p>
    <?php endif; ?>

    <?php if(!empty($mensagemErro)): ?>
        <p style="color: red;"><?php echo $mensagemErro; ?></p>
    <?php endif; ?>

    <?php if (!empty($usuario)): ?>
        <form action="update.php?id=<?php echo $usuario['id']; ?>" method="POST">
            <label for="nome">Nome:</label><br>
            <input type="text" name="nome" id="nome"
                   value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>
            <br><br>

            <label for="email">Email:</label><br>
            <input type="email" name="email" id="email"
                   value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
            <br><br>

            <button type="submit">Atualizar</button>
        </form>
    <?php endif; ?>

    <p><a href="read.php">Voltar para a lista de usuários</a></p>
    </body>
    </html>

<?php
/*
  --- RECOMENDAÇÃO DE MELHORIA (COMENTÁRIO GRANDE) ---

  - Novamente, num projeto MVC, teríamos um método "update" em um "controller" específico,
    e a lógica de busca/atualização dos dados ficaria em um "model" (ex: UsuarioModel).
  - Podemos implementar validações de dados mais específicas, como verificar se o email
    está no formato correto com filter_var($email, FILTER_VALIDATE_EMAIL).
  - Poderíamos tratar a situação de "usuário não encontrado" de forma mais elegante,
    talvez exibindo uma página de erro ou redirecionando automaticamente para a listagem.
  - Em caso de sucesso, poderíamos redirecionar para a listagem de usuários em vez de ficar
    na mesma página, evitando o "problema do refresh" (reenvio de dados).
  - Em um cenário mais complexo, poderíamos versionar essas alterações, ter logs detalhados
    sobre quem realizou a atualização (caso haja login, por exemplo).
*/
