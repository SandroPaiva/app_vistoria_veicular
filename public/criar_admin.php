<?php
// Arquivo: public/criar_admin.php
require_once '../app/Core/Database.php';
require_once '../app/Models/Usuario.php';

$db = (new Database())->conectar();
$usuario = new Usuario($db);

// Usaremos um e-mail fictício da sua empresa para contextualizar
if ($usuario->cadastrar('Administrador', 'admin@multidados.com', '123456', 'admin')) {
  echo "Usuário Admin criado com sucesso! E-mail: admin@multidados.com | Senha: 123456";
} else {
  echo "Erro ao criar admin. Talvez ele já exista no banco.";
}
?>