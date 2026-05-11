<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
  header("Location: index.php");
  exit;
}
require_once '../app/Controllers/VeiculoController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $controller = new VeiculoController();
  $controller->atualizar($_POST);
} else {
  header("Location: veiculos.php");
}
?>
