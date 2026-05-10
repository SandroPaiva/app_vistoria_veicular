<?php
// Arquivo: app/Controllers/ItemController.php

require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Models/Item.php';
require_once __DIR__ . '/../Models/Categoria.php'; // Precisamos das categorias também!

class ItemController
{
  private $db;
  private $itemModel;
  private $categoriaModel;

  public function __construct()
  {
    $database = new Database();
    $this->db = $database->conectar();
    $this->itemModel = new Item($this->db);
    $this->categoriaModel = new Categoria($this->db);
  }

  public function index()
  {
    // Busca as duas listas
    $categorias = $this->categoriaModel->listarTodas();
    $itens = $this->itemModel->listarTodos();

    require_once __DIR__ . '/../../views/itens.php';
  }

  public function salvar($categoria_id, $nome, $ordem)
  {
    if ($this->itemModel->cadastrar($categoria_id, $nome, $ordem)) {
      header("Location: itens.php");
      exit;
    } else {
      echo "Erro ao cadastrar o item.";
    }
  }
}
?>