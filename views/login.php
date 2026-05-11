<!-- Arquivo: views/login.php -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Vistoria Veicular</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="login-body">
  <div class="login-box">
    <h2>Acesso ao Sistema</h2>
    <!-- O formulário envia os dados para autenticar.php usando o método POST -->
    <form action="autenticar.php" method="POST">
      <input type="email" name="email" placeholder="E-mail" required>
      <input type="password" name="senha" placeholder="Senha" required>
      <button type="submit">Entrar</button>
    </form>
  </div>
</body>

</html>