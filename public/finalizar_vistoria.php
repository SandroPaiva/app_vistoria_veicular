<?php
// Arquivo: public/finalizar_vistoria.php
session_start();
if (!isset($_SESSION['usuario_id'])) {
  header("Location: index.php");
  exit;
}

if (isset($_GET['id'])) {
  require_once '../app/Controllers/VistoriaController.php';
  $controller = new VistoriaController();
  $controller->finalizar((int) $_GET['id']);
} else {
  header("Location: dashboard.php");
  exit;
}
?>