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
                <input type="radio" name="status_<?php echo $item['id']; ?>" id="ok_<?php echo $item['id']; ?>" value="ok">
                <label for="ok_<?php echo $item['id']; ?>">✔ OK</label>

                <input type="radio" name="status_<?php echo $item['id']; ?>" id="avaria_<?php echo $item['id']; ?>"
                  value="avaria">
                <label for="avaria_<?php echo $item['id']; ?>">✖ Avaria</label>

                <input type="radio" name="status_<?php echo $item['id']; ?>" id="na_<?php echo $item['id']; ?>" value="n/a">
                <label for="na_<?php echo $item['id']; ?>">N/A</label>
              </div>

              <input type="text" class="obs-input" id="obs_<?php echo $item['id']; ?>"
                placeholder="Observações (Opcional)...">

              <!-- O botão de foto virá na Fase 4 -->
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    <?php endforeach; ?>

    <button class="btn-concluir"
      onclick="if(confirm('Tem certeza que deseja finalizar esta vistoria? Não será possível alterá-la depois.')) { window.location.href='finalizar_vistoria.php?id=<?php echo isset($vistoria['id']) ? $vistoria['id'] : 'N/A'; ?>'; }">Finalizar
      Vistoria</button>
  </div>
  <script>
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
  </script>
</body>

</html>