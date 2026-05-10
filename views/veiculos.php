<!-- Arquivo: views/veiculos.php -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Veículos - Vistoria Veicular</title>
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

    .voltar {
      display: inline-block;
      margin-bottom: 20px;
      background: #6c757d;
      color: white;
      padding: 10px 15px;
      text-decoration: none;
      border-radius: 5px;
    }

    .form-cadastro {
      background: #e9ecef;
      padding: 20px;
      border-radius: 8px;
      margin-bottom: 20px;
    }

    .form-row {
      display: flex;
      gap: 10px;
      margin-bottom: 10px;
      flex-wrap: wrap;
    }

    input,
    select {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      flex: 1;
      min-width: 150px;
    }

    button {
      padding: 10px 20px;
      background: #28a745;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-weight: bold;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    th,
    td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: left;
    }

    th {
      background-color: #0056b3;
      color: white;
    }
  </style>
</head>

<body>
  <div class="container">
    <a href="dashboard.php" class="voltar">⬅ Voltar ao Painel</a>
    <h2>Gerenciamento de Veículos</h2>

    <!-- Formulário de Cadastro -->
    <div class="form-cadastro">
      <h3>Cadastrar Novo Veículo</h3>
      <form action="salvar_veiculo.php" method="POST">
        <div class="form-row">
          <input type="text" name="placa" placeholder="Placa (Ex: ABC1D23)" required maxlength="10">
          <input type="text" name="chassi" placeholder="Chassi (Opcional)" maxlength="50">
          <input type="text" name="marca" placeholder="Marca" required>
          <input type="text" name="modelo" placeholder="Modelo" required>
          <input type="number" name="ano" placeholder="Ano (Ex: 2024)" required min="1900" max="2100">
          <select name="tipo" required>
            <option value="">Selecione o Tipo...</option>
            <option value="Carro">Carro</option>
            <option value="Caminhao">Caminhão</option>
            <option value="Van">Van</option>
            <option value="Micro-onibus">Micro-ônibus</option>
            <option value="Outros">Outros</option>
          </select>
        </div>
        <button type="submit">💾 Salvar Veículo</button>
      </form>
    </div>

    <!-- Tabela de Listagem -->
    <h3>Veículos Cadastrados</h3>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Placa</th>
          <th>Marca / Modelo</th>
          <th>Ano</th>
          <th>Tipo</th>
        </tr>
      </thead>
      <tbody>
        <!-- O PHP interage com o HTML para gerar as linhas da tabela dinamicamente -->
        <?php if (!empty($veiculos)): ?>
          <?php foreach ($veiculos as $v): ?>
            <tr>
              <td>
                <?php echo $v['id']; ?>
              </td>
              <td>
                <?php echo htmlspecialchars($v['placa']); ?>
              </td>
              <td>
                <?php echo htmlspecialchars($v['marca']) . ' ' . htmlspecialchars($v['modelo']); ?>
              </td>
              <td>
                <?php echo htmlspecialchars($v['ano']); ?>
              </td>
              <td>
                <?php echo htmlspecialchars($v['tipo']); ?>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5" style="text-align: center;">Nenhum veículo cadastrado ainda.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>

</html>