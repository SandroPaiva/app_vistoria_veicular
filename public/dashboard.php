<?php
// Arquivo: public/dashboard.php
session_start();

if (!isset($_SESSION['usuario_id'])) {
  header("Location: index.php");
  exit;
}

// Agora passamos a responsabilidade de carregar a View para o Controller
require_once '../app/Controllers/DashboardController.php';
$controller = new DashboardController();
$controller->index();
?>