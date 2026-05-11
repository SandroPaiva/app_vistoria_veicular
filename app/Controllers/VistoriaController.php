<?php
// Arquivo: app/Controllers/VistoriaController.php

require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Models/Vistoria.php';
require_once __DIR__ . '/../Models/Veiculo.php'; // Precisamos listar os veículos

require_once __DIR__ . '/../../vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

class VistoriaController
{
  private $db;
  private $vistoriaModel;
  private $veiculoModel;

  public function __construct()
  {
    $database = new Database();
    $this->db = $database->conectar();
    $this->vistoriaModel = new Vistoria($this->db);
    $this->veiculoModel = new Veiculo($this->db);
  }

  // Carrega a tela inicial para escolher o veículo
  public function nova()
  {
    $veiculos = $this->veiculoModel->listarTodos();
    require_once __DIR__ . '/../../views/nova_vistoria.php';
  }

  // Processa a criação da vistoria no banco
  public function iniciar($veiculo_id, $usuario_id)
  {
    $vistoria_id = $this->vistoriaModel->iniciar($veiculo_id, $usuario_id);

    if ($vistoria_id) {
      // Redireciona para a tela do checklist, passando o ID na URL
      header("Location: checklist.php?id=" . $vistoria_id);
      exit;
    } else {
      echo "Erro ao iniciar a vistoria.";
    }
  }
  // Método para carregar a tela de preenchimento do checklist
  public function checklist($id)
  {
    // 1. Busca os dados da Vistoria
    $vistoria = $this->vistoriaModel->buscarPorId($id);

    if (!$vistoria) {
      echo "Erro: Vistoria não encontrada.";
      return;
    }

    // 2. Precisamos instanciar os models de Categoria e Item aqui
    require_once __DIR__ . '/../Models/Categoria.php';
    require_once __DIR__ . '/../Models/Item.php';

    $categoriaModel = new Categoria($this->db);
    $itemModel = new Item($this->db);

    // 3. Busca todas as categorias e itens para montar a tela
    $categorias = $categoriaModel->listarTodas();
    $itens = $itemModel->listarTodos();

    // 4. Carrega a View
    require_once __DIR__ . '/../../views/checklist.php';
  }
  // Recebe os dados do JavaScript e retorna um JSON
  public function salvarRespostaAjax($dados)
  {
    $vistoria_id = (int) $dados['vistoria_id'];
    $item_id = (int) $dados['item_id'];
    $status_item = $dados['status_item'] ?? null;
    $observacao = $dados['observacao'] ?? null;

    if ($this->vistoriaModel->salvarRespostaItem($vistoria_id, $item_id, $status_item, $observacao)) {
      echo json_encode(['sucesso' => true]);
    } else {
      echo json_encode(['sucesso' => false, 'erro' => 'Falha ao salvar no banco']);
    }
  }

  // Método para finalizar e travar a vistoria
  public function finalizar($id)
  {
    if ($this->vistoriaModel->finalizarVistoria($id)) {
      // Sucesso! Por enquanto, volta pro Dashboard. Na próxima fase, geraremos o PDF aqui.
      header("Location: dashboard.php?msg=vistoria_concluida");
      exit;
    } else {
      echo "Erro ao finalizar a vistoria.";
    }
  }
  // Recebe a foto via AJAX, salva no servidor e registra no banco
  public function uploadFotoAjax($dados, $arquivos)
  {
    $vistoria_id = (int) $dados['vistoria_id'];
    $item_id = (int) $dados['item_id'];

    // Verifica se a imagem realmente foi enviada sem erros
    if (isset($arquivos['foto']) && $arquivos['foto']['error'] === UPLOAD_ERR_OK) {

      $diretorio_destino = __DIR__ . '/../../public/uploads/';

      // Gera um nome único para a imagem para evitar substituições (ex: vist_5_item_12_1689000.jpg)
      $extensao = pathinfo($arquivos['foto']['name'], PATHINFO_EXTENSION);
      $nome_arquivo = "vist_{$vistoria_id}_item_{$item_id}_" . time() . "." . $extensao;

      $caminho_completo = $diretorio_destino . $nome_arquivo;

      // Move o arquivo da memória temporária para a pasta final
      if (move_uploaded_file($arquivos['foto']['tmp_name'], $caminho_completo)) {
        // Se salvou o arquivo, grava no banco de dados o caminho relativo
        $caminho_banco = 'uploads/' . $nome_arquivo;
        $this->vistoriaModel->salvarFoto($vistoria_id, $item_id, $caminho_banco);

        echo json_encode(['sucesso' => true, 'caminho' => $caminho_banco]);
        return;
      }
    }

    echo json_encode(['sucesso' => false, 'erro' => 'Falha ao processar o upload da imagem.']);
  }
  // Método para gerar e exibir o PDF do laudo
  public function gerarPdf($id)
  {
    $vistoria = $this->vistoriaModel->buscarPorId($id);
    $respostas = $this->vistoriaModel->buscarRelatorioCompleto($id);

    if (!$vistoria || $vistoria['status'] !== 'concluida') {
      die("Erro: Vistoria não encontrada ou ainda não foi finalizada.");
    }

    // Liga o "Gravador de Tela" do PHP para capturar o HTML
    ob_start();
    require_once __DIR__ . '/../../views/pdf_template.php';
    $html = ob_get_clean(); // Desliga o gravador e salva tudo na variável $html

    // Configura e gera o PDF
    $options = new Options();
    $options->set('isRemoteEnabled', true); // Permite carregar imagens

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Attachment => false abre o PDF no navegador. Se for true, força o download.
    $dompdf->stream("laudo_vistoria_{$id}.pdf", ["Attachment" => false]);
  // Carrega a tela com o histórico de vistorias
  public function historico()
  {
    $vistorias = $this->vistoriaModel->listarTodas();
    require_once __DIR__ . '/../../views/historico_vistorias.php';
  }
}
?>