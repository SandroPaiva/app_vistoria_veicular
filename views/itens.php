<!-- Arquivo: views/itens.php -->
<?php
// Initialize variables if not already set
if (!isset($categorias)) {
    $categorias = [];
}
if (!isset($itens)) {
    $itens = [];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Itens de Checklist - Vistoria Veicular</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 900px;
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

    .form-row {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
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
    <h2>Itens de Vistoria</h2>

    <form action="salvar_item.php" method="POST" class="form-row">
      <!-- Select alimentado dinamicamente pelo banco de dados -->
      <select name="categoria_id" required>
        <option value="">Selecione o Grupo/Categoria...</option>
        <?php foreach ($categorias as $cat): ?>
          <option value="<?php echo $cat['id']; ?>">
            <?php echo htmlspecialchars($cat['nome']); ?>
          </option>
        <?php endforeach; ?>
      </select>

      <input type="text" name="nome" placeholder="Nome do Item (Ex: Para-brisa)" required>
      <input type="number" name="ordem" placeholder="Ordem (Ex: 1)" required style="max-width: 100px;">
      <button type="submit">➕ Adicionar Item</button>
    </form>

    <table>
      <thead>
        <tr>
          <th>Grupo (Categoria)</th>
          <th>Ordem</th>
          <th>Nome do Item</th>
          <th>Status</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($itens)): ?>
          <?php foreach ($itens as $item): ?>
            <tr>
              <td><strong>
                  <?php echo htmlspecialchars($item['categoria_nome']); ?>
                </strong></td>
              <td>
                <?php echo htmlspecialchars($item['ordem']); ?>
              </td>
              <td>
                <?php echo htmlspecialchars($item['nome']); ?>
              </td>
              <td>
                <?php echo $item['ativo'] ? 'Ativo' : 'Inativo'; ?>
              </td>
              <td>
                <a href="editar_item.php?id=<?php echo $item['id']; ?>" style="color: #0056b3; text-decoration: none; margin-right: 10px;">✏️ Editar</a>
                <a href="excluir_item.php?id=<?php echo $item['id']; ?>" style="color: #dc3545; text-decoration: none;" onclick="return confirm('Tem certeza que deseja excluir este item?');">🗑️ Excluir</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="4" style="text-align: center;">Nenhum item cadastrado.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>

</html>