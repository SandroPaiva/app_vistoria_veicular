<!-- Arquivo: views/pdf_template.php -->
<?php
// Ensure $vistoria variable is defined
if (!isset($vistoria)) {
  $vistoria = [];
}
// Ensure $respostas variable is defined
if (!isset($respostas)) {
  $respostas = [];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>Laudo de Vistoria #
    <?php echo isset($vistoria['id']) ? $vistoria['id'] : 'N/A'; ?>
  </title>
  <style>
    body {
      font-family: Helvetica, Arial, sans-serif;
      font-size: 12px;
      color: #333;
    }

    .header {
      text-align: center;
      border-bottom: 2px solid #0056b3;
      padding-bottom: 10px;
      margin-bottom: 20px;
    }

    .header h1 {
      margin: 0;
      color: #0056b3;
      font-size: 24px;
    }

    .info-box {
      border: 1px solid #ccc;
      padding: 10px;
      margin-bottom: 20px;
      background-color: #f9f9f9;
    }

    .info-box p {
      margin: 5px 0;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    th,
    td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #0056b3;
      color: white;
    }

    .status-ok {
      color: green;
      font-weight: bold;
    }

    .status-avaria {
      color: red;
      font-weight: bold;
    }

    .foto-avaria {
      max-width: 100px;
      max-height: 100px;
    }
  </style>
</head>

<body>

  <div class="header">
    <h1>LAUDO TÉCNICO DE VISTORIA VEICULAR</h1>
    <p>Documento Oficial - Vistoria #
      <?php echo isset($vistoria['id']) ? $vistoria['id'] : 'N/A'; ?>
    </p>
  </div>

  <div class="info-box">
    <p><strong>Veículo:</strong>
      <?php echo isset($vistoria['marca'], $vistoria['modelo']) ? htmlspecialchars($vistoria['marca'] . ' ' . $vistoria['modelo']) : 'N/A'; ?>
    </p>
    <p><strong>Placa:</strong>
      <?php echo isset($vistoria['placa']) ? htmlspecialchars($vistoria['placa']) : 'N/A'; ?>
    </p>
    <p><strong>Data de Finalização:</strong>
      <?php echo isset($vistoria['data_fim']) ? date('d/m/Y H:i', strtotime($vistoria['data_fim'])) : 'N/A'; ?>
    </p>
  </div>

  <h3>Resultados do Checklist</h3>
  <table>
    <thead>
      <tr>
        <th>Categoria</th>
        <th>Item</th>
        <th>Status</th>
        <th>Observação</th>
        <th>Foto</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($respostas as $resp): ?>
        <tr>
          <td>
            <?php echo htmlspecialchars($resp['categoria_nome']); ?>
          </td>
          <td>
            <?php echo htmlspecialchars($resp['item_nome']); ?>
          </td>
          <td>
            <?php
            if ($resp['status_item'] == 'ok')
              echo "<span class='status-ok'>✔ OK</span>";
            elseif ($resp['status_item'] == 'avaria')
              echo "<span class='status-avaria'>✖ AVARIA</span>";
            else
              echo "N/A";
            ?>
          </td>
          <td>
            <?php echo htmlspecialchars($resp['observacao']); ?>
          </td>
          <td>
            <?php if (!empty($resp['caminho_arquivo'])): ?>
              <!-- Para o Dompdf ler a imagem local, precisamos passar o caminho absoluto do servidor -->
              <img src="<?php echo __DIR__ . '/../../public/' . $resp['caminho_arquivo']; ?>" class="foto-avaria">
            <?php else: ?>
              -
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

</body>

</html>