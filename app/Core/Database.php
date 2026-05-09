<?php
// Arquivo: app/Core/Database.php

class Database
{
  private $host = 'localhost';
  private $db_name = 'sistema_vistoria';
  private $username = 'root'; // Padrão do XAMPP/Laragon
  private $password = 'Paiva@351522';     // Padrão do XAMPP (vazio)
  private $conn;

  public function conectar()
  {
    $this->conn = null;

    try {
      // Cria a conexão PDO
      $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4", $this->username, $this->password);

      // Define o modo de erro do PDO para lançar exceções (Exceptions)
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // Descomente a linha abaixo apenas para testar se funcionou, depois comente novamente.
      // echo "Conexão com o banco de dados realizada com sucesso!";

    } catch (PDOException $e) {
      echo "Erro de Conexão: " . $e->getMessage();
    }

    return $this->conn;
  }
}
?>