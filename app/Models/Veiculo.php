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
    $query = "SELECT id, placa, marca, modelo, ano, tipo, nome_cliente, telefone FROM " . $this->table_name . " ORDER BY id DESC";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    // Retorna todos os registros encontrados como um array associativo
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Método para cadastrar um novo veículo (usaremos a forma simplificada de array no execute)
  public function cadastrar($dados)
  {
    $query = "INSERT INTO " . $this->table_name . " 
                  (placa, chassi, marca, modelo, ano, tipo, nome_cliente, telefone) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $this->conn->prepare($query);

    // O execute pode receber diretamente um array com os valores na ordem dos placeholders (?)
    if (
      $stmt->execute([
        $dados['placa'],
        $dados['chassi'],
        $dados['marca'],
        $dados['modelo'],
        $dados['ano'],
        $dados['tipo'],
        $dados['nome_cliente'] ?? null,
        $dados['telefone'] ?? null
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

  // Lista todas as marcas únicas cadastradas
  public function listarMarcas()
  {
    $query = "SELECT DISTINCT marca FROM " . $this->table_name . " WHERE marca != '' ORDER BY marca ASC";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Lista todos os modelos únicos de uma determinada marca
  public function listarModelos($marca)
  {
    $query = "SELECT DISTINCT modelo FROM " . $this->table_name . " WHERE marca = ? AND modelo != '' ORDER BY modelo ASC";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $marca);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function buscarPorId($id)
  {
    $query = "SELECT id, placa, chassi, marca, modelo, ano, tipo, nome_cliente, telefone FROM " . $this->table_name . " WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function atualizar($dados)
  {
    $query = "UPDATE " . $this->table_name . " 
                  SET placa = ?, chassi = ?, marca = ?, modelo = ?, ano = ?, tipo = ?, nome_cliente = ?, telefone = ?
                  WHERE id = ?";
    $stmt = $this->conn->prepare($query);

    return $stmt->execute([
      $dados['placa'],
      $dados['chassi'],
      $dados['marca'],
      $dados['modelo'],
      $dados['ano'],
      $dados['tipo'],
      $dados['nome_cliente'] ?? null,
      $dados['telefone'] ?? null,
      $dados['id']
    ]);
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