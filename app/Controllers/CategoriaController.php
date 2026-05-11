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

  public function editar($id)
  {
    $categoria = $this->categoriaModel->buscarPorId($id);
    if ($categoria) {
      require_once __DIR__ . '/../../views/editar_categoria.php';
    } else {
      echo "Categoria não encontrada.";
    }
  }

  public function atualizar($id, $nome, $ordem)
  {
    if ($this->categoriaModel->atualizar($id, $nome, $ordem)) {
      header("Location: categorias.php");
      exit;
    } else {
      echo "Erro ao atualizar a categoria.";
    }
  }

  public function excluir($id)
  {
    // Cuidado: excluir categoria pode falhar se houver itens associados (chave estrangeira)
    // O ideal seria inativar ou garantir que exclua em cascata.
    // Vamos tentar excluir.
    if ($this->categoriaModel->excluir($id)) {
      header("Location: categorias.php");
      exit;
    } else {
      echo "Erro ao excluir a categoria. Verifique se existem itens associados a ela.";
    }
  }
}
?>