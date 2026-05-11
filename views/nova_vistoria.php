<!-- Arquivo: views/nova_vistoria.php -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nova Vistoria - Vistoria Veicular</title>
  <link rel="stylesheet" href="assets/css/style.css">
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