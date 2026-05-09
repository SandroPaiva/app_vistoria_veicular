<?php
// Arquivo: public/autenticar.php
require_once '../app/Controllers/UsuarioController.php';

// Verifica se os dados vieram via formulário POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $senha = $_POST['senha'];

  $controller = new UsuarioController();

  if ($controller->login($email, $senha)) {
    // Redireciona para o painel principal
    header("Location: dashboard.php");
    exit; // Sempre use exit após um header de redirecionamento
  } else {
    echo "E-mail ou senha incorretos. <br><br> <a href='index.php'>Voltar e tentar novamente</a>";
  }
}
?>