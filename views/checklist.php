<!-- Arquivo: views/checklist.php -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Execução de Checklist - Vistoria</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <div class="container">
    <div class="cabecalho-os">
      <h2>Vistoria #
        <?php echo isset($vistoria['id']) ? $vistoria['id'] : 'N/A'; ?>
      </h2>
      <p><strong>Veículo:</strong>
        <?php echo isset($vistoria['placa'], $vistoria['marca'], $vistoria['modelo']) ? htmlspecialchars($vistoria['placa']) . ' - ' . htmlspecialchars($vistoria['marca'] . ' ' . $vistoria['modelo']) : 'N/A'; ?>
      </p>
      <p><strong>Cliente:</strong>
        <?php echo isset($vistoria['nome_cliente']) && !empty($vistoria['nome_cliente']) ? htmlspecialchars($vistoria['nome_cliente']) : 'Não informado'; ?>
      </p>
    </div>

    <p style="color: #666; font-size: 14px;">Os dados são salvos automaticamente ao clicar.</p>

    <!-- Loop pelas Categorias -->
    <?php foreach (isset($categorias) ? $categorias : [] as $cat): ?>
      <div class="categoria-box">
        <h3 class="categoria-titulo">
          <?php echo htmlspecialchars($cat['nome']); ?>
          <button type="button" class="btn-todos" onclick="marcarTodosCategoria(<?php echo $cat['id']; ?>, 'n/a')">N/A
            Todos</button>
          <button type="button" class="btn-todos" onclick="marcarTodosCategoria(<?php echo $cat['id']; ?>, 'ok')">✔ Todos
            OK</button>
        </h3>

        <!-- Loop pelos Itens -->
        <?php foreach (isset($itens) ? $itens : [] as $item): ?>
          <!-- O IF verifica se o item pertence a esta categoria do loop atual -->
          <?php if ($item['categoria_id'] == $cat['id']): ?>
            <div class="item-linha">
              <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                <strong style="flex: 1; min-width: 200px; font-size: 16px;">
                  <?php echo htmlspecialchars($item['nome']); ?>
                </strong>

                <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                  <div class="opcoes-status" style="margin: 0;">
                    <!-- Os IDs precisam ser únicos para o HTML entender, por isso usamos o ID do item -->
                    <input type="radio" name="status_<?php echo $item['id']; ?>" id="ok_<?php echo $item['id']; ?>" value="ok"
                      data-categoria="<?php echo $cat['id']; ?>">
                    <label for="ok_<?php echo $item['id']; ?>">✔ OK</label>

                    <input type="radio" name="status_<?php echo $item['id']; ?>" id="avaria_<?php echo $item['id']; ?>"
                      value="avaria" data-categoria="<?php echo $cat['id']; ?>">
                    <label for="avaria_<?php echo $item['id']; ?>">✖ Avaria</label>

                    <input type="radio" name="status_<?php echo $item['id']; ?>" id="na_<?php echo $item['id']; ?>"
                      value="n/a" data-categoria="<?php echo $cat['id']; ?>">
                    <label for="na_<?php echo $item['id']; ?>">N/A</label>
                  </div>

                  <!-- Botão de Foto na mesma linha -->
                  <div>
                    <input type="file" id="foto_<?php echo $item['id']; ?>" accept="image/*" capture="environment"
                      style="display:none;" onchange="enviarFoto(<?php echo $item['id']; ?>)">

                    <button type="button" class="btn-foto opcoes-status"
                      onclick="document.getElementById('foto_<?php echo $item['id']; ?>').click()"
                      style="padding: 15px 5px; background: #FAFAFA; border: 2px solid var(--border-color); border-radius: var(--radius); cursor: pointer; font-weight: 600; display: flex; align-items: center; justify-content: center; min-width: 120px;">
                      📷 Foto
                    </button>
                  </div>
                </div>
              </div>

              <input type="text" class="obs-input" id="obs_<?php echo $item['id']; ?>"
                placeholder="Observações (Opcional)...">

              <!-- Local onde a miniatura da foto vai aparecer após o upload -->
              <div id="galeria_<?php echo $item['id']; ?>"
                style="display: flex; gap: 10px; margin-top: 5px; flex-wrap: wrap;"></div>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    <?php endforeach; ?>

    <button class="btn-concluir" onclick="validarEFinalizar()">Finalizar Vistoria</button>
  </div>
  <script>
    // Função para validar se todos os itens foram respondidos antes de finalizar
    // Nova função de validação com pintura de itens faltantes
    function validarEFinalizar() {
      let faltam = 0;

      // Passa por todas as linhas de itens na tela
      document.querySelectorAll('.item-linha').forEach(linha => {
        // Procura se tem algum radio marcado dentro DESSA linha específica
        const respondido = linha.querySelector('input[type="radio"]:checked');

        if (!respondido) {
          linha.classList.add('erro-validacao'); // Pinta a linha de vermelho
          faltam++;
        } else {
          linha.classList.remove('erro-validacao'); // Tira o vermelho se estiver OK
        }
      });

      if (faltam > 0) {
        alert(`ATENÇÃO!\n\nFaltam ${faltam} item(ns) para serem avaliados.\nEles foram destacados em vermelho para facilitar a localização.\n\nO sistema não permite finalizar vistorias incompletas.`);
        return;
      }

      if (confirm('Tem certeza que deseja finalizar esta vistoria? Não será possível alterá-la depois.')) {
        window.location.href = 'finalizar_vistoria.php?id=<?php echo isset($vistoria['id']) ? $vistoria['id'] : ''; ?>';
      }
    }

    // Função para marcar todos os itens de uma categoria
    function marcarTodosCategoria(catId, status) {
      if (confirm(`Deseja marcar todos os itens desta categoria como ${status.toUpperCase()}?`)) {
        // Seleciona todos os rádios que tenham a categoria clicada E o valor clicado
        const radios = document.querySelectorAll(`input[data-categoria="${catId}"][value="${status}"]`);

        radios.forEach(radio => {
          // Só altera se não estiver marcado
          if (!radio.checked) {
            radio.checked = true;

            // IMPORTANTE: Tira o erro vermelho caso a linha estivesse vermelha
            radio.closest('.item-linha').classList.remove('erro-validacao');

            // Pegamos o ID do item e forçamos o salvamento no banco de dados!
            const itemId = radio.id.split('_')[1];
            salvarItem(itemId);
          }
        });
      }
    }
    // Função que pega os dados do item e manda pro PHP sem recarregar a tela
    function salvarItem(itemId) {
      const vistoriaId = <?php echo isset($vistoria['id']) ? $vistoria['id'] : 'null'; ?>;

      // Pega qual botão de rádio foi selecionado (OK, Avaria, etc)
      const statusRadio = document.querySelector(`input[name="status_${itemId}"]:checked`);
      const statusValor = statusRadio ? statusRadio.value : null;

      // Pega o texto da observação
      const obsInput = document.getElementById(`obs_${itemId}`);
      const obsValor = obsInput ? obsInput.value : '';

      if (statusValor) {
        // Prepara o "pacote" de dados
        const formData = new FormData();
        formData.append('vistoria_id', vistoriaId);
        formData.append('item_id', itemId);
        formData.append('status_item', statusValor);
        formData.append('observacao', obsValor);

        // Dispara a requisição para o nosso arquivo PHP
        fetch('api_salvar_item.php', {
          method: 'POST',
          body: formData
        })
          .then(response => response.json())
          .then(data => {
            if (data.sucesso) {
              console.log(`✓ Item ${itemId} salvo no banco!`);
            }
          })
          .catch(error => console.error('Erro de conexão:', error));
      }
    }

    // Coloca um "espião" (Event Listener) em todos os botões de rádio
    document.querySelectorAll('input[type="radio"]').forEach(radio => {
      radio.addEventListener('change', function () {
        // O id do rádio é tipo "ok_5" ou "avaria_12". Dividimos pelo "_" para pegar só o número
        const itemId = this.id.split('_')[1];
        salvarItem(itemId);
      });
    });

    // Coloca o espião nas observações para salvar quando o usuário tirar o dedo do campo (evento 'blur')
    document.querySelectorAll('.obs-input').forEach(input => {
      input.addEventListener('blur', function () {
        const itemId = this.id.split('_')[1];
        salvarItem(itemId);
      });
    });
    // Função para interceptar o arquivo escolhido e mandar pro servidor via AJAX
    function enviarFoto(itemId) {
      const inputFoto = document.getElementById(`foto_${itemId}`);
      const vistoriaId = <?php echo isset($vistoria['id']) ? $vistoria['id'] : 'null'; ?>;

      // Verifica se o usuário realmente selecionou um arquivo ou cancelou
      if (inputFoto.files.length > 0) {
        const arquivo = inputFoto.files[0];
        const formData = new FormData();

        formData.append('vistoria_id', vistoriaId);
        formData.append('item_id', itemId);
        formData.append('foto', arquivo); // Anexa o arquivo físico ao pacote

        // Muda o texto do botão para dar feedback visual
        const btn = inputFoto.nextElementSibling;
        const textoOriginal = btn.innerHTML;
        btn.innerHTML = '⏳ Enviando...';

        fetch('api_upload_foto.php', {
          method: 'POST',
          body: formData
        })
          .then(response => response.json())
          .then(data => {
            btn.innerHTML = textoOriginal; // Restaura o botão

            if (data.sucesso) {
              // Cria uma miniatura da foto e joga na tela
              const galeria = document.getElementById(`galeria_${itemId}`);
              const img = document.createElement('img');
              img.src = data.caminho;
              img.style = "width: 80px; height: 80px; object-fit: cover; border-radius: 4px; border: 1px solid #ccc;";
              galeria.appendChild(img);
            } else {
              alert(data.erro);
            }
          })
          .catch(error => {
            btn.innerHTML = textoOriginal;
            console.error('Erro de conexão:', error);
            alert("Erro ao enviar a imagem.");
          });
      }
    }
  </script>
</body>

</html>