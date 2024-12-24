<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Página Inicial</title>
</head>
<body>
<h1>Bem-vindo ao nosso Gerenciador de Usuários</h1>
<ul>
    <li><a href="create.php">Criar Novo Usuário</a></li>
    <li><a href="read.php">Listar Usuários</a></li>
</ul>
</body>
</html>

<?php
/*
  --- RECOMENDAÇÃO DE MELHORIA (COMENTÁRIO GRANDE) ---

  - Em projetos profissionais, normalmente se utiliza um "Front Controller" (um index.php único)
    que recebe todas as requisições e, então, despacha para as rotas adequadas. Isso facilita
    bastante o desenvolvimento, especialmente seguindo estruturas de frameworks como Laravel,
    Symfony, etc.
  - Poderíamos ter um sistema de login para proteger o acesso (somente usuários autenticados
    podem ver, criar, atualizar e excluir).
  - Poderíamos trazer algum tipo de dashboard ou estatística na página inicial.
  - Mais adiante, a aplicação poderia evoluir para um padrão MVC ou até mesmo um microframework,
    para organização do projeto.
*/
