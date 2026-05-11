<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
  header("Location: index.php");
  exit;
}

require_once '../app/Controllers/VistoriaController.php';
$controller = new VistoriaController();
$controller->historico();
?>
