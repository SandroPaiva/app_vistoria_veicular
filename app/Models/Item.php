<?php
// Arquivo: app/Models/Item.php

class Item
{
  private $conn;
  private $table_name = "itens_checklist";

  public function __construct($db)
  {
    $this->conn = $db;
  }

  // Lista os itens combinando com a tabela de categorias para pegar o nome
  public function listarTodos()
  {
    $query = "SELECT i.id, i.categoria_id, i.nome, i.ordem, i.ativo, c.nome as categoria_nome 
                  FROM " . $this->table_name . " i
                  INNER JOIN categorias_checklist c ON i.categoria_id = c.id
                  ORDER BY c.ordem ASC, i.ordem ASC";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Cadastra um novo item vinculado a uma categoria
  public function cadastrar($categoria_id, $nome, $ordem = 0)
  {
    $query = "INSERT INTO " . $this->table_name . " (categoria_id, nome, ordem) VALUES (?, ?, ?)";
    $stmt = $this->conn->prepare($query);

    $nome = htmlspecialchars(strip_tags($nome));

    $stmt->bindParam(1, $categoria_id);
    $stmt->bindParam(2, $nome);
    $stmt->bindParam(3, $ordem);

    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  public function buscarPorId($id)
  {
    $query = "SELECT id, categoria_id, nome, ordem, ativo FROM " . $this->table_name . " WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function atualizar($id, $categoria_id, $nome, $ordem)
  {
    $query = "UPDATE " . $this->table_name . " SET categoria_id = ?, nome = ?, ordem = ? WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $nome = htmlspecialchars(strip_tags($nome));
    $stmt->bindParam(1, $categoria_id);
    $stmt->bindParam(2, $nome);
    $stmt->bindParam(3, $ordem);
    $stmt->bindParam(4, $id);
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