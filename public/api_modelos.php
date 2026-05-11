<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
  header("HTTP/1.1 401 Unauthorized");
  exit;
}

require_once '../app/Controllers/VeiculoController.php';

$marca = $_GET['marca'] ?? '';

$controller = new VeiculoController();
header('Content-Type: application/json');
$controller->buscarModelosAjax($marca);
?>
