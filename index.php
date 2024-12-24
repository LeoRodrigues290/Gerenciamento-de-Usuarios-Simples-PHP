<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Página Inicial</title>
    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h1 class="mb-4">Bem-vindo ao nosso Gerenciador de Usuários</h1>
    <div class="list-group">
        <a href="create.php" class="list-group-item list-group-item-action">Criar Novo Usuário</a>
        <a href="read.php" class="list-group-item list-group-item-action">Listar Usuários</a>
    </div>
</div>

<!-- Bootstrap JS (CDN) + Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
/*
  --- RECOMENDAÇÃO DE MELHORIA (COMENTÁRIO GRANDE) ---
  - Em projetos profissionais, normalmente se utiliza um "Front Controller" (um index.php único)
    que recebe todas as requisições e, então, despacha para as rotas adequadas.
  - Poderíamos ter um sistema de login para proteger o acesso (somente usuários autenticados).
  - Poderíamos trazer algum tipo de dashboard ou estatística na página inicial.
  - Mais adiante, a aplicação poderia evoluir para um padrão MVC ou até mesmo um microframework,
    para organização do projeto.
*/
?>
