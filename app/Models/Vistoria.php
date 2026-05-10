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
  // Busca a vistoria pelo ID trazendo também a placa, marca e modelo do veículo
  public function buscarPorId($id)
  {
    $query = "SELECT v.*, ve.placa, ve.marca, ve.modelo 
                  FROM " . $this->table_name . " v
                  INNER JOIN veiculos ve ON v.veiculo_id = ve.id
                  WHERE v.id = ?";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $id);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
  // Salva ou atualiza a resposta de um item específico do checklist
  public function salvarRespostaItem($vistoria_id, $item_id, $status_item, $observacao)
  {
    $query = "INSERT INTO vistoria_itens (vistoria_id, item_id, status_item, observacao) 
                  VALUES (?, ?, ?, ?) 
                  ON DUPLICATE KEY UPDATE status_item = VALUES(status_item), observacao = VALUES(observacao)";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $vistoria_id);
    $stmt->bindParam(2, $item_id);
    $stmt->bindParam(3, $status_item);
    $stmt->bindParam(4, $observacao);

    return $stmt->execute();
  }

  // Método para encerrar a vistoria
  public function finalizarVistoria($id)
  {
    $query = "UPDATE " . $this->table_name . " 
                  SET status = 'concluida', data_fim = CURRENT_TIMESTAMP 
                  WHERE id = ?";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $id);

    return $stmt->execute();
  }



}
?>