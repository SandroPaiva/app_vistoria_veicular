<?php
// Arquivo: app/Models/Categoria.php

class Categoria
{
  private $conn;
  private $table_name = "categorias_checklist";

  public function __construct($db)
  {
    $this->conn = $db;
  }

  // Método para listar todas as categorias ativas
  public function listarTodas()
  {
    $query = "SELECT id, nome, ordem, ativo FROM " . $this->table_name . " ORDER BY ordem ASC";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Método para cadastrar uma nova categoria
  public function cadastrar($nome, $ordem = 0)
  {
    $query = "INSERT INTO " . $this->table_name . " (nome, ordem) VALUES (?, ?)";
    $stmt = $this->conn->prepare($query);

    $nome = htmlspecialchars(strip_tags($nome));

    $stmt->bindParam(1, $nome);
    $stmt->bindParam(2, $ordem);

    if ($stmt->execute()) {
      return true;
    }
    return false;
  }
}
?>