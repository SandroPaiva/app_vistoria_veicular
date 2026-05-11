<!-- Arquivo: views/editar_item.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Editar Item - Vistoria Veicular</title>
  <style>
    body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; }
    .container { max-width: 800px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
    .voltar { display: inline-block; margin-bottom: 20px; background: #6c757d; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; }
    .form-row { display: flex; gap: 10px; margin-bottom: 20px; flex-wrap: wrap; }
    input, select { padding: 10px; border: 1px solid #ccc; border-radius: 4px; flex: 1; min-width: 150px; }
    button { padding: 10px 20px; background: #0056b3; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
  </style>
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
