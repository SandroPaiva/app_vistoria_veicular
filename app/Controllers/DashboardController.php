<?php
// Arquivo: app/Controllers/DashboardController.php

require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Models/Veiculo.php';
require_once __DIR__ . '/../Models/Vistoria.php';

class DashboardController
{
  private $db;
  private $veiculoModel;
  private $vistoriaModel;

  public function __construct()
  {
    $database = new Database();
    $this->db = $database->conectar();
    $this->veiculoModel = new Veiculo($this->db);
    $this->vistoriaModel = new Vistoria($this->db);
  }

  public function index()
  {
    // Coleta os indicadores (KPIs)
    $totalVeiculos = $this->veiculoModel->contarTodos();
    $vistoriasAndamento = $this->vistoriaModel->contarPorStatus('em_andamento');
    $vistoriasConcluidas = $this->vistoriaModel->contarPorStatus('concluida');

    // Carrega a interface passando as variáveis
    require_once __DIR__ . '/../../views/dashboard.php';
  }
}
?>