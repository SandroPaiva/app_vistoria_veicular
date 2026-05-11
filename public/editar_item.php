<?php
session_start();
if (!isset($_SESSION['usuario_id']) || !in_array($_SESSION['usuario_perfil'], ['admin', 'supervisor'])) {
  header("Location: index.php");
  exit;
}
require_once '../app/Controllers/ItemController.php';

$id = $_GET['id'] ?? null;
if ($id) {
  $controller = new ItemController();
  $controller->editar($id);
} else {
  header("Location: itens.php");
}
?>
