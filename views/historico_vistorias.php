<!-- Arquivo: views/historico_vistorias.php -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Histórico de Vistorias - Vistoria Veicular</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <div class="container">
    <a href="dashboard.php" class="voltar">⬅ Voltar ao Painel</a>
    <h2>Histórico de Vistorias</h2>

    <div class="table-responsive">
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
  </div>
</body>

</html>
