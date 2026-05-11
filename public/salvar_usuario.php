<?php
session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_perfil'] !== 'admin') {
  header("Location: index.php");
  exit;
}

require_once '../app/Controllers/UsuarioController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nome = $_POST['nome'] ?? '';
  $email = $_POST['email'] ?? '';
  $senha = $_POST['senha'] ?? '';
  $perfil = $_POST['perfil'] ?? '';

  if (!empty($nome) && !empty($email) && !empty($senha) && !empty($perfil)) {
    $controller = new UsuarioController();
    $controller->salvar($nome, $email, $senha, $perfil);
  } else {
    echo "Todos os campos são obrigatórios.";
  }
} else {
  header("Location: usuarios.php");
  exit;
}
?>
