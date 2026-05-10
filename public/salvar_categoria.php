<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
  header("Location: index.php");
  exit;
}

require_once '../app/Controllers/CategoriaController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nome = $_POST['nome'];
  $ordem = empty($_POST['ordem']) ? 0 : (int) $_POST['ordem'];

  $controller = new CategoriaController();
  $controller->salvar($nome, $ordem);
}
?>