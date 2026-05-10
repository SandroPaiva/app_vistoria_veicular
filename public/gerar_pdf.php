<?php
// Arquivo: public/gerar_pdf.php
session_start();
if (!isset($_SESSION['usuario_id'])) {
  header("Location: index.php");
  exit;
}

if (isset($_GET['id'])) {
  require_once '../app/Controllers/VistoriaController.php';
  $controller = new VistoriaController();
  $controller->gerarPdf((int) $_GET['id']);
} else {
  echo "ID da vistoria não informado.";
}
?>