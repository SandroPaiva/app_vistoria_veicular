<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
  header("Location: index.php");
  exit;
}

require_once '../app/Controllers/CategoriaController.php';
$controller = new CategoriaController();
$controller->index();
?>