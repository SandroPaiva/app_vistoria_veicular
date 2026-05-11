<?php
// Arquivo: app/Controllers/UsuarioController.php

// Requisita as dependências necessárias
require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Models/Usuario.php';

class UsuarioController
{
  private $db;
  private $usuarioModel;

  public function __construct()
  {
    $database = new Database();
    $this->db = $database->conectar();
    $this->usuarioModel = new Usuario($this->db);
  }

  // Método responsável por processar a tentativa de login
  public function login($email, $senha)
  {
    // Busca os dados do usuário no banco
    $usuario = $this->usuarioModel->buscarPorEmail($email);

    // Verifica se o usuário existe e se a senha digitada bate com o hash salvo
    if ($usuario && password_verify($senha, $usuario['senha_hash'])) {

      // Inicia a sessão do PHP para guardar as informações do usuário logado
      if (session_status() === PHP_SESSION_NONE) {
        session_start();
      }

      // Grava os dados essenciais na sessão
      $_SESSION['usuario_id'] = $usuario['id'];
      $_SESSION['usuario_nome'] = $usuario['nome'];
      $_SESSION['usuario_perfil'] = $usuario['perfil'];

      return true; // Login com sucesso
    }

    return false; // Falha no login (e-mail ou senha incorretos)
  }

  // Carrega a tela com todos os usuários
  public function index()
  {
    $usuarios = $this->usuarioModel->listarTodos();
    require_once __DIR__ . '/../../views/usuarios.php';
  }

  // Processa o salvamento de um novo usuário
  public function salvar($nome, $email, $senha, $perfil)
  {
    if ($this->usuarioModel->cadastrar($nome, $email, $senha, $perfil)) {
      header("Location: usuarios.php");
      exit;
    } else {
      echo "Erro ao cadastrar o usuário.";
    }
  }
}
?>