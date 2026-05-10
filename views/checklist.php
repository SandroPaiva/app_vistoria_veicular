<!-- Arquivo: views/checklist.php -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Execução de Checklist - Vistoria</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
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

    .cabecalho-os {
      background: #0056b3;
      color: white;
      padding: 15px;
      border-radius: 5px;
      margin-bottom: 20px;
    }

    .categoria-box {
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-bottom: 15px;
      overflow: hidden;
    }

    .categoria-titulo {
      background: #e9ecef;
      padding: 10px 15px;
      margin: 0;
      font-size: 18px;
      border-bottom: 1px solid #ccc;
    }

    .item-linha {
      padding: 15px;
      border-bottom: 1px solid #eee;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .item-linha:last-child {
      border-bottom: none;
    }

    .opcoes-status {
      display: flex;
      gap: 10px;
    }

    /* Estilizando os botões de rádio para ficarem grandes (Touch-friendly para Tablets) */
    .opcoes-status label {
      flex: 1;
      text-align: center;
      padding: 15px 5px;
      border: 2px solid #ccc;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
      background: #fafafa;
    }

    .opcoes-status input[type="radio"] {
      display: none;
    }

    /* Esconde a bolinha padrão */

    /* Cores quando selecionado (Nós ativaremos isso via JS no próximo passo, mas o CSS já fica pronto) */
    .opcoes-status input[value="ok"]:checked+label {
      border-color: #28a745;
      background: #d4edda;
      color: #155724;
    }

    .opcoes-status input[value="avaria"]:checked+label {
      border-color: #dc3545;
      background: #f8d7da;
      color: #721c24;
    }

    .opcoes-status input[value="n/a"]:checked+label {
      border-color: #6c757d;
      background: #e2e3e5;
      color: #383d41;
    }

    .obs-input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      margin-top: 5px;
    }

    .btn-concluir {
      display: block;
      width: 100%;
      padding: 15px;
      background: #28a745;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 18px;
      font-weight: bold;
      cursor: pointer;
      margin-top: 20px;
    }

    /* Adicione dentro da tag <style> */
    .item-linha.erro-validacao {
      background-color: #fff3f3;
      border-left: 5px solid #dc3545;
    }

    .btn-todos {
      font-size: 12px;
      padding: 5px 10px;
      background: #17a2b8;
      color: white;
      border: none;
      border-radius: 3px;
      cursor: pointer;
      float: right;
      margin-left: 5px;
      font-weight: normal;
    }

    .btn-todos:hover {
      background: #138496;
    }
  </style>
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
              <strong>
                <?php echo htmlspecialchars($item['nome']); ?>
              </strong>

              <div class="opcoes-status">
                <!-- Os IDs precisam ser únicos para o HTML entender, por isso usamos o ID do item -->
                <input type="radio" name="status_<?php echo $item['id']; ?>" id="ok_<?php echo $item['id']; ?>" value="ok"
                  data-categoria="<?php echo $cat['id']; ?>">
                <label for="ok_<?php echo $item['id']; ?>">✔ OK</label>

                <input type="radio" name="status_<?php echo $item['id']; ?>" id="avaria_<?php echo $item['id']; ?>"
                  value="avaria" data-categoria="<?php echo $cat['id']; ?>">
                <label for="avaria_<?php echo $item['id']; ?>">✖ Avaria</label>

                <input type="radio" name="status_<?php echo $item['id']; ?>" id="na_<?php echo $item['id']; ?>" value="n/a"
                  data-categoria="<?php echo $cat['id']; ?>">
                <label for="na_<?php echo $item['id']; ?>">N/A</label>
              </div>

              <input type="text" class="obs-input" id="obs_<?php echo $item['id']; ?>"
                placeholder="Observações (Opcional)...">

              <!-- Bloco de Foto (Invisível o input real, usamos um botão bonitinho para clicar nele) -->
              <div style="margin-top: 10px;">
                <!-- O atributo capture="environment" força o Android/iOS a abrir a câmera traseira em vez dos arquivos -->
                <input type="file" id="foto_<?php echo $item['id']; ?>" accept="image/*" capture="environment"
                  style="display:none;" onchange="enviarFoto(<?php echo $item['id']; ?>)">

                <button type="button" class="btn-foto"
                  onclick="document.getElementById('foto_<?php echo $item['id']; ?>').click()"
                  style="padding: 8px 15px; background: #6c757d; color: white; border: none; border-radius: 4px; cursor: pointer;">
                  📷 Tirar Foto
                </button>

                <!-- Local onde a miniatura da foto vai aparecer após o upload -->
                <div id="galeria_<?php echo $item['id']; ?>"
                  style="display: flex; gap: 10px; margin-top: 10px; flex-wrap: wrap;"></div>
              </div>
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