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

  public function buscarPorId($id)
  {
    $query = "SELECT id, nome, ordem, ativo FROM " . $this->table_name . " WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function atualizar($id, $nome, $ordem)
  {
    $query = "UPDATE " . $this->table_name . " SET nome = ?, ordem = ? WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $nome = htmlspecialchars(strip_tags($nome));
    $stmt->bindParam(1, $nome);
    $stmt->bindParam(2, $ordem);
    $stmt->bindParam(3, $id);
    return $stmt->execute();
  }

  public function excluir($id)
  {
    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $id);
    return $stmt->execute();
  }
}
?>