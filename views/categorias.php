<!-- Arquivo: views/categorias.php -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Categorias - Vistoria Veicular</title>
  <link rel="stylesheet" href="assets/css/style.css">
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
    <div class="table-responsive">
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
              <td colspan="4" style="text-align: center;">Nenhuma categoria cadastrada.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>