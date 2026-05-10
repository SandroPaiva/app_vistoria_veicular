<?php
// Arquivo: public/checklist.php
session_start();
if (!isset($_SESSION['usuario_id'])) {
  header("Location: index.php");
  exit;
}

// Verifica se o ID foi passado na URL (Ex: checklist.php?id=5)
if (!isset($_GET['id'])) {
  header("Location: dashboard.php");
  exit;
}

require_once '../app/Controllers/VistoriaController.php';
$controller = new VistoriaController();

// Passa o ID da URL para o controlador
$controller->checklist((int) $_GET['id']);
?>