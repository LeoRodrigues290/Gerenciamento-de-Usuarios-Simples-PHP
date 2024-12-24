# Gerenciamento-de-Usuarios-Simples-PHP
Etapa 1: Estrutura de Pastas
Primeiro, vamos definir uma estrutura básica de pastas. O projeto será extremamente simples, mas já vamos organizá-lo minimamente:

arduino
Copiar código
meu_projeto/
│   index.php        // Página inicial (opcionalmente lista os usuários)
│
├── config/
│   └── db.php       // Arquivo responsável pela conexão com o banco de dados
│
├── create.php       // Arquivo para criar um novo usuário
├── read.php         // Arquivo para listar e visualizar usuários
├── update.php       // Arquivo para atualizar dados de um usuário
└── delete.php       // Arquivo para excluir um usuário
Observação: É uma estrutura simples. Em um projeto maior, poderíamos separar as responsabilidades em camadas (MVC), mas como nosso foco é “PHP puro” e básico, manteremos tudo de forma direta.

CREATE TABLE IF NOT EXISTS `usuarios` (
`id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`nome` VARCHAR(100) NOT NULL,
`email` VARCHAR(100) NOT NULL,
`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

Diferença entre API e API RESTful: Uma API é qualquer interface de programação para comunicar sistemas. Já uma API RESTful segue princípios REST (como uso de recursos, métodos HTTP, representação de estado, etc.).