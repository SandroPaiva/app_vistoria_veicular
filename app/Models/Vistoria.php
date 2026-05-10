<?php
// Arquivo: app/Models/Vistoria.php

class Vistoria
{
  private $conn;
  private $table_name = "vistorias";

  public function __construct($db)
  {
    $this->conn = $db;
  }

  // Inicia uma nova vistoria e retorna o ID gerado
  public function iniciar($veiculo_id, $usuario_id)
  {
    $query = "INSERT INTO " . $this->table_name . " (veiculo_id, usuario_id) VALUES (?, ?)";
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(1, $veiculo_id);
    $stmt->bindParam(2, $usuario_id);

    if ($stmt->execute()) {
      // Retorna o ID da vistoria que acabou de ser inserida!
      return $this->conn->lastInsertId();
    }
    return false;
  }
}
?>