<?php
session_start();
if (!isset($_SESSION['usuario_id']) || !in_array($_SESSION['usuario_perfil'], ['admin', 'supervisor'])) {
  header("Location: index.php");
  exit;
}
require_once '../app/Controllers/CategoriaController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'] ?? null;
  $nome = $_POST['nome'] ?? '';
  $ordem = (int)($_POST['ordem'] ?? 0);

  if ($id && !empty($nome)) {
    $controller = new CategoriaController();
    $controller->atualizar($id, $nome, $ordem);
  } else {
    echo "Dados incompletos.";
  }
} else {
  header("Location: categorias.php");
}
?>
