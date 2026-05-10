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
}
?>