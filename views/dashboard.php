<!-- Arquivo: views/dashboard.php -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Vistoria Veicular</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid #ccc;
      padding-bottom: 10px;
      margin-bottom: 20px;
    }

    .btn-sair {
      background: #dc3545;
      color: white;
      text-decoration: none;
      padding: 10px 15px;
      border-radius: 5px;
      font-weight: bold;
    }

    .btn-sair:hover {
      background: #c82333;
    }

    .menu a {
      display: inline-block;
      background: #0056b3;
      color: white;
      text-decoration: none;
      padding: 15px 20px;
      border-radius: 5px;
      margin-right: 10px;
      font-weight: bold;
    }

    .menu a:hover {
      background: #004494;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <div>
        <h2>Painel de Vistorias</h2>
        <p>Bem-vindo(a), <strong>
            <?php echo $_SESSION['usuario_nome']; ?>
          </strong> (Perfil:
          <?php echo ucfirst($_SESSION['usuario_perfil']); ?>)
        </p>
      </div>
      <a href="logout.php" class="btn-sair">Sair</a>
    </div>

    <div class="menu">
      <!-- Em breve criaremos esta rota -->
      <a href="veiculos.php">🚗 Gerenciar Veículos</a>
      <a href="#">📋 Nova Vistoria</a>
      <a href="categorias.php">📋 Cadastrar Categorias</a>
      <a href="itens.php">✅ Cadastrar Itens de Vistoria</a>
      <a href="nova_vistoria.php">📊 Realizar Vistoria</a>
    </div>
</body>

</html>