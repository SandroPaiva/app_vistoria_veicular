<?php
// Arquivo: public/api_upload_foto.php
session_start();
if (!isset($_SESSION['usuario_id'])) {
  echo json_encode(['sucesso' => false, 'erro' => 'Não autorizado']);
  exit;
}

require_once '../app/Controllers/VistoriaController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $controller = new VistoriaController();
  // Passamos o $_POST (com os IDs) e o $_FILES (com a imagem física)
  $controller->uploadFotoAjax($_POST, $_FILES);
}
?>