<?php
// Inicia a sessão.
session_start();
// Destroi a sessão e redireciona para o login.
session_destroy();
header('Location: index.php');
exit;
?>
