<?php
// Arquivo: public/index.php

// Requisita o arquivo de conexão
require_once '../app/Core/Database.php';

// Instancia a classe e tenta conectar
$db = new Database();
$conexao = $db->conectar();

?>