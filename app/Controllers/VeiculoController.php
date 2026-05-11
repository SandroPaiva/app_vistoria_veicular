<?php
// Arquivo: app/Controllers/VeiculoController.php

require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Models/Veiculo.php';

class VeiculoController
{
  private $db;
  private $veiculoModel;

  public function __construct()
  {
    $database = new Database();
    $this->db = $database->conectar();
    $this->veiculoModel = new Veiculo($this->db);
  }

  // Método para pegar os veículos e enviar para a View (Tela)
  public function index()
  {
    // Busca os veículos no banco
    $veiculos = $this->veiculoModel->listarTodos();
    $marcas = $this->veiculoModel->listarMarcas();

    // Carrega a tela de listagem, passando os dados
    require_once __DIR__ . '/../../views/veiculos.php';
  }
  // Método para processar o salvamento de um novo veículo
  public function salvar($dados)
  {
    // Envia os dados para o Model cadastrar no banco
    if ($this->veiculoModel->cadastrar($dados)) {
      // Se der certo, recarrega a página de veículos
      header("Location: veiculos.php");
      exit;
    } else {
      echo "Erro ao cadastrar o veículo. Talvez a placa já exista.";
    }
  }

  // Retorna os modelos em JSON para o AJAX
  public function buscarModelosAjax($marca)
  {
    $modelos = $this->veiculoModel->listarModelos($marca);
    echo json_encode($modelos);
  }
}
?>