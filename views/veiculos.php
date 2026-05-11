<!-- Arquivo: views/veiculos.php -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Veículos - Vistoria Veicular</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <div class="container">
    <a href="dashboard.php" class="voltar">⬅ Voltar ao Painel</a>
    <h2>Gerenciamento de Veículos</h2>

    <!-- Formulário de Cadastro -->
    <div class="form-cadastro">
      <h3>Cadastrar Novo Veículo</h3>
      <form action="salvar_veiculo.php" method="POST">
        <div class="form-row">
          <input type="text" name="placa" placeholder="Placa (Ex: ABC1D23)" required maxlength="10">
          <input type="text" name="chassi" placeholder="Chassi (Opcional)" maxlength="50">
          <input type="text" name="marca" id="inputMarca" list="listaMarcas" placeholder="Marca (Digite ou escolha)" required autocomplete="off">
          <datalist id="listaMarcas">
            <?php if (!empty($marcas)): ?>
              <?php foreach ($marcas as $m): ?>
                <option value="<?php echo htmlspecialchars($m['marca']); ?>"></option>
              <?php endforeach; ?>
            <?php endif; ?>
          </datalist>

          <input type="text" name="modelo" id="inputModelo" list="listaModelos" placeholder="Modelo (Digite ou escolha)" required autocomplete="off">
          <datalist id="listaModelos">
            <!-- As options serão carregadas via JavaScript -->
          </datalist>
          <input type="text" name="ano" placeholder="Ano (Ex: 2024)" required min="1900" max="2100" style="max-width: 100px;">
          <select name="tipo" required>
            <option value="">Selecione o Tipo...</option>
            <option value="Carro">Carro</option>
            <option value="Caminhao">Caminhão</option>
            <option value="Van">Van</option>
            <option value="Micro-onibus">Micro-ônibus</option>
            <option value="Outros">Outros</option>
          </select>
        </div>
        <div class="form-row">
          <input type="text" name="nome_cliente" placeholder="Nome do Cliente" maxlength="100" required>
          <input type="text" name="telefone" placeholder="Telefone (Ex: (11) 99999-9999)" maxlength="15" required style="max-width: 250px;" oninput="mascaraTelefone(this)">
        </div>
        <button type="submit">💾 Salvar Veículo</button>
      </form>
    </div>

    <!-- Tabela de Listagem -->
    <h3>Veículos Cadastrados</h3>
    <div class="table-responsive">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Placa</th>
            <th>Marca / Modelo</th>
            <th>Ano</th>
            <th>Tipo</th>
            <th>Cliente</th>
            <th>Telefone</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <!-- O PHP interage com o HTML para gerar as linhas da tabela dinamicamente -->
          <?php if (!empty($veiculos)): ?>
            <?php foreach ($veiculos as $v): ?>
              <tr>
                <td>
                  <?php echo $v['id']; ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($v['placa']); ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($v['marca']) . ' ' . htmlspecialchars($v['modelo']); ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($v['ano']); ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($v['tipo']); ?>
                </td>
                <td>
                  <?php echo !empty($v['nome_cliente']) ? htmlspecialchars($v['nome_cliente']) : '-'; ?>
                </td>
                <td>
                  <?php echo !empty($v['telefone']) ? htmlspecialchars($v['telefone']) : '-'; ?>
                </td>
                <td>
                  <a href="editar_veiculo.php?id=<?php echo $v['id']; ?>" style="color: #0056b3; text-decoration: none; margin-right: 10px;">✏️ Editar</a>
                  <?php if (isset($_SESSION['usuario_perfil']) && in_array($_SESSION['usuario_perfil'], ['admin', 'supervisor'])): ?>
                  <a href="excluir_veiculo.php?id=<?php echo $v['id']; ?>" style="color: #dc3545; text-decoration: none;" onclick="return confirm('Tem certeza que deseja excluir?');">🗑️ Excluir</a>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="8" style="text-align: center;">Nenhum veículo cadastrado ainda.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
  <script>
    document.getElementById('inputMarca').addEventListener('input', function() {
      const marcaSelecionada = this.value;
      const datalistModelos = document.getElementById('listaModelos');
      const inputModelo = document.getElementById('inputModelo');

      // Limpa os modelos anteriores
      datalistModelos.innerHTML = '';
      
      if (marcaSelecionada.length > 0) {
        // Faz a requisição AJAX
        fetch(`api_modelos.php?marca=${encodeURIComponent(marcaSelecionada)}`)
          .then(response => response.json())
          .then(data => {
            data.forEach(m => {
              const option = document.createElement('option');
              option.value = m.modelo;
              datalistModelos.appendChild(option);
            });
          })
          .catch(error => console.error('Erro ao buscar modelos:', error));
      }
    });

    function mascaraTelefone(input) {
      let v = input.value.replace(/\D/g, '');
      if (v.length > 11) v = v.substring(0, 11);
      
      if (v.length > 2) {
        v = v.replace(/^(\d{2})(\d)/g, '($1) $2');
      }
      if (v.length > 13) {
        v = v.replace(/(\d{5})(\d)/, '$1-$2'); // (99) 99999-9999
      } else if (v.length > 9) {
        v = v.replace(/(\d{4})(\d)/, '$1-$2'); // (99) 9999-9999
      } else if (v.length > 8) {
        // Formata na digitação a partir de certa quantidade de digitos
        v = v.replace(/(\d{4,5})(\d)/, '$1-$2');
      }
      input.value = v;
    }
  </script>
</body>

</html>