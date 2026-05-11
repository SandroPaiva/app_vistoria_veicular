<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
  header("Location: index.php");
  exit;
}
require_once '../app/Controllers/VeiculoController.php';

$id = $_GET['id'] ?? null;
if ($id) {
  $controller = new VeiculoController();
  $controller->editar($id);
} else {
  header("Location: veiculos.php");
}
?>
