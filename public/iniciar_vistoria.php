<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
  header("Location: index.php");
  exit;
}

require_once '../app/Controllers/VistoriaController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $veiculo_id = (int) $_POST['veiculo_id'];
  $usuario_id = (int) $_SESSION['usuario_id']; // Pegamos o ID de quem está logado!

  $controller = new VistoriaController();
  $controller->iniciar($veiculo_id, $usuario_id);
}
?>