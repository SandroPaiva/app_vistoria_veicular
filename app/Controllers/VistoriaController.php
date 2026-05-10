<?php
// Arquivo: app/Controllers/VistoriaController.php

require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Models/Vistoria.php';
require_once __DIR__ . '/../Models/Veiculo.php'; // Precisamos listar os veículos

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
}
?>