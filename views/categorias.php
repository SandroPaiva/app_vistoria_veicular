<!-- Arquivo: views/categorias.php -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Categorias - Vistoria Veicular</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 800px;
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
    }

    input {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      flex: 1;
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
    <h2>Grupos de Checklist (Categorias)</h2>

    <!-- Formulário de Cadastro -->
    <form action="salvar_categoria.php" method="POST" class="form-row">
      <input type="text" name="nome" placeholder="Nome da Categoria (Ex: Lataria)" required>
      <input type="number" name="ordem" placeholder="Ordem de Exibição (Ex: 1)" required style="max-width: 150px;">
      <button type="submit">➕ Adicionar</button>
    </form>

    <!-- Tabela de Listagem -->
    <table>
      <thead>
        <tr>
          <th>Ordem</th>
          <th>Nome da Categoria</th>
          <th>Status</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($categorias)): ?>
          <?php foreach ($categorias as $cat): ?>
            <tr>
              <td>
                <?php echo htmlspecialchars($cat['ordem']); ?>
              </td>
              <td>
                <?php echo htmlspecialchars($cat['nome']); ?>
              </td>
              <td>
                <?php echo $cat['ativo'] ? 'Ativo' : 'Inativo'; ?>
              </td>
              <td>
                <a href="editar_categoria.php?id=<?php echo $cat['id']; ?>" style="color: #0056b3; text-decoration: none; margin-right: 10px;">✏️ Editar</a>
                <a href="excluir_categoria.php?id=<?php echo $cat['id']; ?>" style="color: #dc3545; text-decoration: none;" onclick="return confirm('Tem certeza que deseja excluir esta categoria? Isso pode afetar itens relacionados!');">🗑️ Excluir</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="3" style="text-align: center;">Nenhuma categoria cadastrada.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>

</html>