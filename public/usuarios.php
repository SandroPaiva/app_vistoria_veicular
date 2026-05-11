<?php
session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_perfil'] !== 'admin') {
  header("Location: index.php");
  exit;
}

require_once '../app/Controllers/UsuarioController.php';
$controller = new UsuarioController();
$controller->index();
?>
