<!-- Arquivo: views/editar_veiculo.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Editar Veículo - Vistoria Veicular</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="container">
    <a href="veiculos.php" class="voltar">⬅ Voltar para Veículos</a>
    <h2>Editar Veículo</h2>
    <form action="atualizar_veiculo.php" method="POST">
      <input type="hidden" name="id" value="<?php echo htmlspecialchars($veiculo['id']); ?>">
      <div class="form-row">
        <input type="text" name="placa" value="<?php echo htmlspecialchars($veiculo['placa']); ?>" required maxlength="10">
        <input type="text" name="chassi" value="<?php echo htmlspecialchars($veiculo['chassi']); ?>" maxlength="50" placeholder="Chassi (Opcional)">
        
        <input type="text" name="marca" id="inputMarca" list="listaMarcas" value="<?php echo htmlspecialchars($veiculo['marca']); ?>" required autocomplete="off">
        <datalist id="listaMarcas">
          <?php if (!empty($marcas)): ?>
            <?php foreach ($marcas as $m): ?>
              <option value="<?php echo htmlspecialchars($m['marca']); ?>"></option>
            <?php endforeach; ?>
          <?php endif; ?>
        </datalist>

        <input type="text" name="modelo" id="inputModelo" list="listaModelos" value="<?php echo htmlspecialchars($veiculo['modelo']); ?>" required autocomplete="off">
        <datalist id="listaModelos">
          <!-- Modelos serão carregados pelo JS se alterar a marca, mas o valor atual já está no input -->
        </datalist>
        
        <input type="text" name="ano" value="<?php echo htmlspecialchars($veiculo['ano']); ?>" required style="max-width: 100px;">
        
        <select name="tipo" required>
          <option value="Carro" <?php echo $veiculo['tipo'] === 'Carro' ? 'selected' : ''; ?>>Carro</option>
          <option value="Caminhao" <?php echo $veiculo['tipo'] === 'Caminhao' ? 'selected' : ''; ?>>Caminhão</option>
          <option value="Van" <?php echo $veiculo['tipo'] === 'Van' ? 'selected' : ''; ?>>Van</option>
          <option value="Micro-onibus" <?php echo $veiculo['tipo'] === 'Micro-onibus' ? 'selected' : ''; ?>>Micro-ônibus</option>
          <option value="Outros" <?php echo $veiculo['tipo'] === 'Outros' ? 'selected' : ''; ?>>Outros</option>
        </select>
      </div>
      <div class="form-row">
        <input type="text" name="nome_cliente" value="<?php echo htmlspecialchars($veiculo['nome_cliente'] ?? ''); ?>" placeholder="Nome do Cliente" maxlength="100" required>
        <input type="text" name="telefone" value="<?php echo htmlspecialchars($veiculo['telefone'] ?? ''); ?>" placeholder="Telefone do Cliente" maxlength="15" required style="max-width: 250px;" oninput="mascaraTelefone(this)">
      </div>
      <button type="submit">💾 Salvar Alterações</button>
    </form>
  </div>
  <script>
    document.getElementById('inputMarca').addEventListener('input', function() {
      const marcaSelecionada = this.value;
      const datalistModelos = document.getElementById('listaModelos');
      datalistModelos.innerHTML = '';
      if (marcaSelecionada.length > 0) {
        fetch(`api_modelos.php?marca=${encodeURIComponent(marcaSelecionada)}`)
          .then(response => response.json())
          .then(data => {
            data.forEach(m => {
              const option = document.createElement('option');
              option.value = m.modelo;
              datalistModelos.appendChild(option);
            });
          })
          .catch(error => console.error('Erro:', error));
      }
    });

    function mascaraTelefone(input) {
      let v = input.value.replace(/\D/g, '');
      if (v.length > 11) v = v.substring(0, 11);
      
      if (v.length > 2) {
        v = v.replace(/^(\d{2})(\d)/g, '($1) $2');
      }
      if (v.length > 13) {
        v = v.replace(/(\d{5})(\d)/, '$1-$2');
      } else if (v.length > 9) {
        v = v.replace(/(\d{4})(\d)/, '$1-$2');
      } else if (v.length > 8) {
        v = v.replace(/(\d{4,5})(\d)/, '$1-$2');
      }
      input.value = v;
    }
  </script>
</body>
</html>
