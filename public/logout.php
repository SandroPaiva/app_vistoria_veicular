<?php
// Arquivo: public/logout.php
session_start();

// Limpa todas as variáveis de sessão
session_unset();

// Destrói a sessão no servidor
session_destroy();

// Redireciona para o login
header("Location: index.php");
exit;
?>