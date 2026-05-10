<!-- Arquivo: views/nova_vistoria.php -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nova Vistoria - Vistoria Veicular</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      padding: 20px;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      background: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    select {
      width: 100%;
      padding: 15px;
      margin: 20px 0;
      border-radius: 5px;
      font-size: 16px;
    }

    button {
      width: 100%;
      padding: 15px;
      background: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 18px;
      cursor: pointer;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <div class="container">
    <h2>Iniciar Nova Vistoria</h2>
    <p>Selecione o veículo que será inspecionado:</p>

    <form action="iniciar_vistoria.php" method="POST">
      <select name="veiculo_id" required>
        <option value="">Buscar veículo cadastrado...</option>
        <?php if (!empty($veiculos)): ?>
          <?php foreach ($veiculos as $v): ?>
            <option value="<?php echo $v['id']; ?>">
              Placa:
              <?php echo htmlspecialchars($v['placa']); ?> -
              <?php echo htmlspecialchars($v['marca'] . ' ' . $v['modelo']); ?>
            </option>
          <?php endforeach; ?>
        <?php endif; ?>
      </select>

      <button type="submit">📋 Iniciar Checklist Agora</button>
    </form>
    <br>
    <a href="dashboard.php" style="color: #666;">Cancelar e Voltar</a>
  </div>
</body>

</html>