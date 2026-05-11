<?php
// Arquivo: app/Models/Usuario.php

class Usuario
{
  private $conn;
  private $table_name = "usuarios";

  // O construtor recebe a conexão do banco de dados
  public function __construct($db)
  {
    $this->conn = $db;
  }

  // Método para cadastrar um novo usuário
  public function cadastrar($nome, $email, $senha, $perfil)
  {
    // 1. A query SQL com "placeholders" (?) em vez dos valores reais
    $query = "INSERT INTO " . $this->table_name . " (nome, email, senha_hash, perfil) VALUES (?, ?, ?, ?)";

    // 2. Prepara a query
    $stmt = $this->conn->prepare($query);

    // 3. Limpa os dados (Remove tags HTML/PHP inseridas maliciosamente)
    $nome = htmlspecialchars(strip_tags($nome));
    $email = htmlspecialchars(strip_tags($email));
    $perfil = htmlspecialchars(strip_tags($perfil));

    // Criptografa a senha antes de salvar no banco
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // 4. Vincula (bind) os valores aos placeholders (?) da query
    $stmt->bindParam(1, $nome);
    $stmt->bindParam(2, $email);
    $stmt->bindParam(3, $senha_hash);
    $stmt->bindParam(4, $perfil);

    // 5. Executa a query
    if ($stmt->execute()) {
      return true;
    }

    return false;
  }
  // Método para buscar usuário pelo e-mail na hora do login
  public function buscarPorEmail($email)
  {
    $query = "SELECT id, nome, senha_hash, perfil FROM " . $this->table_name . " WHERE email = ? LIMIT 1";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $email);
    $stmt->execute();

    // Retorna um array associativo com os dados do usuário, ou false se não achar
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Método para listar todos os usuários
  public function listarTodos()
  {
    $query = "SELECT id, nome, email, perfil, criado_em FROM " . $this->table_name . " ORDER BY nome ASC";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}