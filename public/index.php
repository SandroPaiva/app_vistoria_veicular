<?php
// Arquivo: public/index.php

// Inicia a sessão para verificar se já existe alguém logado
session_start();

// Carrega a interface visual
require_once '../views/login.php';
?>