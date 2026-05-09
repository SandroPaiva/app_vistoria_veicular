<?php
// Arquivo: public/autenticar.php
require_once '../app/Controllers/UsuarioController.php';

// Verifica se os dados vieram via formulário POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $senha = $_POST['senha'];

  $controller = new UsuarioController();

  if ($controller->login($email, $senha)) {
    echo "<h2>Login realizado com sucesso!</h2>";
    echo "Bem-vindo(a), " . $_SESSION['usuario_nome'] . " (Perfil: " . $_SESSION['usuario_perfil'] . ")";
    // Na próxima fase, trocaremos esse echo por: header("Location: dashboard.php");
  } else {
    echo "E-mail ou senha incorretos. <br><br> <a href='index.php'>Voltar e tentar novamente</a>";
  }
}
?>