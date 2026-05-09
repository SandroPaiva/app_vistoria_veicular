CREATE DATABASE IF NOT EXISTS sistema_vistoria CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE sistema_vistoria;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha_hash VARCHAR(255) NOT NULL,
    perfil ENUM('admin', 'supervisor', 'vistoriador') NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE veiculos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    placa VARCHAR(10) NOT NULL UNIQUE,
    chassi VARCHAR(50),
    marca VARCHAR(50) NOT NULL,
    modelo VARCHAR(50) NOT NULL,
    ano YEAR,
    tipo ENUM('Carro', 'Caminhao', 'Van', 'Micro-onibus', 'Outros') NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);