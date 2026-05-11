<!-- Arquivo: views/editar_categoria.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Editar Categoria - Vistoria Veicular</title>
  <style>
    body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; }
    .container { max-width: 800px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
    .voltar { display: inline-block; margin-bottom: 20px; background: #6c757d; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; }
    .form-row { display: flex; gap: 10px; margin-bottom: 20px; }
    input { padding: 10px; border: 1px solid #ccc; border-radius: 4px; flex: 1; }
    button { padding: 10px 20px; background: #0056b3; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
  </style>
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
