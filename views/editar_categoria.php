<!-- Arquivo: views/editar_categoria.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Editar Categoria - Vistoria Veicular</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="container">
    <a href="categorias.php" class="voltar">⬅ Voltar para Categorias</a>
    <h2>Editar Categoria</h2>
    <form action="atualizar_categoria.php" method="POST" class="form-row">
      <input type="hidden" name="id" value="<?php echo htmlspecialchars($categoria['id']); ?>">
      <input type="text" name="nome" value="<?php echo htmlspecialchars($categoria['nome']); ?>" required>
      <input type="number" name="ordem" value="<?php echo htmlspecialchars($categoria['ordem']); ?>" required style="max-width: 150px;">
      <button type="submit">💾 Salvar Alterações</button>
    </form>
  </div>
</body>
</html>
