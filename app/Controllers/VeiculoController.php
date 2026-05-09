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

    // Carrega a tela de listagem, passando os dados
    require_once __DIR__ . '/../../views/veiculos.php';
  }
}
?>