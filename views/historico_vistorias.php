<!-- Arquivo: views/historico_vistorias.php -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Histórico de Vistorias - Vistoria Veicular</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 1000px;
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

    .status-concluida {
      color: #28a745;
      font-weight: bold;
    }

    .status-andamento {
      color: #ffc107;
      font-weight: bold;
    }

    .btn-pdf {
      background: #dc3545;
      color: white;
      padding: 5px 10px;
      text-decoration: none;
      border-radius: 4px;
      font-size: 14px;
    }

    .btn-pdf:hover {
      background: #c82333;
    }
  </style>
</head>

<body>
  <div class="container">
    <a href="dashboard.php" class="voltar">⬅ Voltar ao Painel</a>
    <h2>Histórico de Vistorias</h2>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Data de Início</th>
          <th>Data de Conclusão</th>
          <th>Veículo (Placa)</th>
          <th>Status</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($vistorias)): ?>
          <?php foreach ($vistorias as $vistoria): ?>
            <tr>
              <td>#<?php echo htmlspecialchars($vistoria['id']); ?></td>
              <td><?php echo htmlspecialchars(date('d/m/Y H:i', strtotime($vistoria['data_inicio']))); ?></td>
              <td>
                <?php echo $vistoria['data_fim'] ? htmlspecialchars(date('d/m/Y H:i', strtotime($vistoria['data_fim']))) : '-'; ?>
              </td>
              <td>
                <?php echo htmlspecialchars($vistoria['marca'] . ' ' . $vistoria['modelo'] . ' (' . $vistoria['placa'] . ')'); ?>
              </td>
              <td class="<?php echo $vistoria['status'] === 'concluida' ? 'status-concluida' : 'status-andamento'; ?>">
                <?php echo ucfirst(htmlspecialchars($vistoria['status'])); ?>
              </td>
              <td>
                <?php if ($vistoria['status'] === 'concluida'): ?>
                  <a href="gerar_pdf.php?id=<?php echo $vistoria['id']; ?>" class="btn-pdf" target="_blank">📄 PDF</a>
                <?php else: ?>
                  <a href="checklist.php?id=<?php echo $vistoria['id']; ?>" style="color: #0056b3;">Continuar</a>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="6" style="text-align: center;">Nenhuma vistoria encontrada no histórico.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>

</html>
