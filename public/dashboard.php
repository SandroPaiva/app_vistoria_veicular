<?php
// Arquivo: public/dashboard.php
session_start();

// PROTEÇÃO DE ROTA: Verifica se a variável de sessão do usuário não existe
if (!isset($_SESSION['usuario_id'])) {
  // Se não existir, expulsa para a tela de login
  header("Location: index.php");
  exit;
}

// Se passou pela verificação, carrega a View
require_once '../views/dashboard.php';
?>