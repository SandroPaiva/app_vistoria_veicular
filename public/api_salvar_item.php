<?php
// Arquivo: public/api_salvar_item.php
session_start();

// Retorna JSON para o JavaScript informando que não está logado
if (!isset($_SESSION['usuario_id'])) {
  echo json_encode(['sucesso' => false, 'erro' => 'Não autorizado']);
  exit;
}

require_once '../app/Controllers/VistoriaController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $controller = new VistoriaController();
  $controller->salvarRespostaAjax($_POST);
}
?>