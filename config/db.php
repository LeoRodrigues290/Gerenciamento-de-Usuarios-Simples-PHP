<?php
/**
 * Arquivo de conexão com o banco de dados.
 * Aqui utilizamos PDO para nos conectarmos ao MySQL.
 * Certifique-se de alterar as variáveis $host, $dbname, $user, $pass para o seu ambiente local.
 */

$host   = 'localhost';  // Geralmente, 'localhost'
$dbname = 'db_usuarios'; // Nome do banco de dados que você criou
$user   = 'root';       // Usuário do seu MySQL
$pass   = '';           // Senha do seu MySQL (em muitos ambientes locais, a senha é vazia)

// Tentamos a conexão dentro de um bloco try-catch para capturar eventuais erros
try {
    $pdo = new PDO("mysql:host={$host};dbname={$dbname}", $user, $pass);
    // Definimos o modo de erro do PDO para exceções (melhor para debug e tratamento de erros)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Caso ocorra um erro, exibimos a mensagem de erro
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

/*
  --- RECOMENDAÇÃO DE MELHORIA ---

  - Em um projeto maior e mais robusto, poderíamos utilizar variáveis de ambiente (env) para armazenar
    os dados de conexão (host, dbname, user, pass), para evitar expor credenciais no código-fonte.
    Essas variáveis ficariam em um arquivo .env (fora do versionamento), e usaríamos bibliotecas como
    vlucas/phpdotenv para carregá-las.

  - Poderíamos criar uma classe de conexão, por exemplo, DatabaseConnection, que retornaria o objeto $pdo.
    Dessa forma, teríamos mais controle e poderíamos implementar Singletons para evitar múltiplas conexões
    desnecessárias.

  - Para maior segurança, é possível criptografar informações de conexão ou usar serviços de gerenciamento
    de segredos (em produção). Assim, as credenciais não ficam expostas diretamente nem no servidor.
  - Em projetos profissionais, implementar tratamento de erros mais detalhado (logging) e não exibir
    erros detalhados em produção (para não revelar detalhes sensíveis).
*/
