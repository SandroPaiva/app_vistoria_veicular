<?php
// Arquivo: public/veiculos.php
session_start();

// Proteção de Rota
if (!isset($_SESSION['usuario_id'])) {
  header("Location: index.php");
  exit;
}

require_once '../app/Controllers/VeiculoController.php';

// Instancia o controlador e chama a página principal de veículos
$controller = new VeiculoController();
$controller->index();
?>