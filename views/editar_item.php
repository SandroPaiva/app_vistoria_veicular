<!-- Arquivo: views/editar_item.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Editar Item - Vistoria Veicular</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="container">
    <a href="itens.php" class="voltar">⬅ Voltar para Itens</a>
    <h2>Editar Item de Vistoria</h2>
    <form action="atualizar_item.php" method="POST" class="form-row">
      <input type="hidden" name="id" value="<?php echo htmlspecialchars($item['id']); ?>">
      
      <select name="categoria_id" required>
        <option value="">Selecione o Grupo (Categoria)</option>
        <?php foreach ($categorias as $cat): ?>
          <option value="<?php echo $cat['id']; ?>" <?php echo $cat['id'] == $item['categoria_id'] ? 'selected' : ''; ?>>
            <?php echo htmlspecialchars($cat['nome']); ?>
          </option>
        <?php endforeach; ?>
      </select>

      <input type="text" name="nome" value="<?php echo htmlspecialchars($item['nome']); ?>" required>
      <input type="number" name="ordem" value="<?php echo htmlspecialchars($item['ordem']); ?>" required style="max-width: 150px;">
      
      <button type="submit">💾 Salvar Alterações</button>
    </form>
  </div>
</body>
</html>
