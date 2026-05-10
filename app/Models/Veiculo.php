<?php
// Arquivo: app/Models/Veiculo.php

class Veiculo
{
  private $conn;
  private $table_name = "veiculos";

  public function __construct($db)
  {
    $this->conn = $db;
  }

  // Método para listar todos os veículos cadastrados
  public function listarTodos()
  {
    $query = "SELECT id, placa, marca, modelo, ano, tipo FROM " . $this->table_name . " ORDER BY id DESC";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    // Retorna todos os registros encontrados como um array associativo
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Método para cadastrar um novo veículo (usaremos a forma simplificada de array no execute)
  public function cadastrar($dados)
  {
    $query = "INSERT INTO " . $this->table_name . " 
                  (placa, chassi, marca, modelo, ano, tipo) 
                  VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $this->conn->prepare($query);

    // O execute pode receber diretamente um array com os valores na ordem dos placeholders (?)
    if (
      $stmt->execute([
        $dados['placa'],
        $dados['chassi'],
        $dados['marca'],
        $dados['modelo'],
        $dados['ano'],
        $dados['tipo']
      ])
    ) {
      return true;
    }

    return false;
  }
  // Retorna o total de veículos cadastrados
  public function contarTodos()
  {
    $query = "SELECT COUNT(*) as total FROM " . $this->table_name;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
  }
}
?>