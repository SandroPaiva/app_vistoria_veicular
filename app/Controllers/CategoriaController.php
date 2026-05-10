<?php
// Arquivo: app/Controllers/CategoriaController.php

require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Models/Categoria.php';

class CategoriaController
{
  private $db;
  private $categoriaModel;

  public function __construct()
  {
    $database = new Database();
    $this->db = $database->conectar();
    $this->categoriaModel = new Categoria($this->db);
  }

  // Carrega a tela com todas as categorias
  public function index()
  {
    $categorias = $this->categoriaModel->listarTodas();
    require_once __DIR__ . '/../../views/categorias.php';
  }

  // Processa o salvamento
  public function salvar($nome, $ordem)
  {
    if ($this->categoriaModel->cadastrar($nome, $ordem)) {
      header("Location: categorias.php");
      exit;
    } else {
      echo "Erro ao cadastrar a categoria.";
    }
  }
}
?>