<?php
// Incluímos a conexão com o banco de dados
require_once __DIR__ . '/config/db.php';

// Inicializamos variáveis para armazenar mensagens de sucesso ou erro
$mensagemSucesso = "";
$mensagemErro    = "";

// Verificamos se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtemos os valores do formulário
    $nome  = $_POST['nome']  ?? null;
    $email = $_POST['email'] ?? null;

    // Verificamos se os campos não estão vazios
    if (!empty($nome) && !empty($email)) {
        try {
            // Preparamos a query de inserção
            $sql = "INSERT INTO usuarios (nome, email) VALUES (:nome, :email)";
            $stmt = $pdo->prepare($sql);
            // Executamos a query com os valores recebidos
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
    </head>
    <body>
    <h1>Criar Usuário</h1>

    <?php if(!empty($mensagemSucesso)): ?>
        <p style="color: green;"><?php echo $mensagemSucesso; ?></p>
    <?php endif; ?>

    <?php if(!empty($mensagemErro)): ?>
        <p style="color: red;"><?php echo $mensagemErro; ?></p>
    <?php endif; ?>

    <!-- Formulário para criar um usuário -->
    <form action="create.php" method="POST">
        <label for="nome">Nome:</label><br>
        <input type="text" name="nome" id="nome" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" name="email" id="email" required><br><br>

        <button type="submit">Criar</button>
    </form>

    <p><a href="index.php">Voltar para a página inicial</a></p>
    </body>
    </html>

<?php
/*
  --- RECOMENDAÇÃO DE MELHORIA (COMENTÁRIO GRANDE) ---

  - Em um projeto mais robusto, separaríamos o que é "lógica de negócio" (inserir no banco)
    do que é "exibição" (HTML) em arquivos diferentes (padrão MVC).
  - Utilizaríamos validações mais avançadas (por exemplo, filtrar e validar o email com filter_var).
  - Poderíamos implementar um token CSRF para garantir que o formulário só seja submetido pelo nosso site.
  - Em vez de imprimir o erro diretamente na tela, poderíamos usar um sistema de log (Monolog, por exemplo)
    para registrar o erro em um arquivo, e exibir ao usuário uma mensagem mais amigável.
  - Poderíamos também usar redirecionamentos (header('Location: ...')) para que, depois de criar um usuário,
    fossemos encaminhados para a lista de usuários (evitando o duplo envio de formulários).
  - Outra boa prática é utilizar um layout ou template único para as páginas, para manter consistência e
    facilitar alterações futuras (tema, cabeçalho, rodapé etc.).
*/
