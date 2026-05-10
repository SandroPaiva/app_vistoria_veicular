<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
  header("Location: index.php");
  exit;
}

require_once '../app/Controllers/ItemController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $categoria_id = (int) $_POST['categoria_id'];
  $nome = $_POST['nome'];
  $ordem = empty($_POST['ordem']) ? 0 : (int) $_POST['ordem'];

  $controller = new ItemController();
  $controller->salvar($categoria_id, $nome, $ordem);
}
?>