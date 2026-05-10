<?php
// Arquivo: public/salvar_veiculo.php
session_start();

// Proteção de rota
if (!isset($_SESSION['usuario_id'])) {
  header("Location: index.php");
  exit;
}

require_once '../app/Controllers/VeiculoController.php';

// Verifica se a requisição é um POST (envio de formulário)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $controller = new VeiculoController();

  // Passa todo o array $_POST (os dados digitados na tela) para o controller salvar
  $controller->salvar($_POST);
}
?>