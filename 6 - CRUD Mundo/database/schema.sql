CREATE DATABASE IF NOT EXISTS bd_mundo;
USE bd_mundo;

CREATE TABLE IF NOT EXISTS continentes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    populacao BIGINT,
    area_km2 DECIMAL(15,2),
    total_paises INT DEFAULT 0
);

CREATE TABLE IF NOT EXISTS governantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    partido_politico VARCHAR(100),
    data_nascimento DATE,
    idade INT,
    data_inicio_mandato DATE,
    data_fim_mandato DATE
);

CREATE TABLE IF NOT EXISTS paises (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    continente_id INT NOT NULL,
    populacao BIGINT,
    area_km2 DECIMAL(15,2),
    idioma VARCHAR(100),
    governante_id INT NULL,
    clima VARCHAR(100),
    regime_politico VARCHAR(100),
    moeda VARCHAR(50),
    FOREIGN KEY (continente_id) REFERENCES continentes(id) ON DELETE RESTRICT,
    FOREIGN KEY (governante_id) REFERENCES governantes(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS cidades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    pais_id INT NOT NULL,
    populacao BIGINT,
    area_km2 DECIMAL(15,2),
    clima VARCHAR(100),
    governante_id INT NULL,
    data_fundacao DATE,
    FOREIGN KEY (pais_id) REFERENCES paises(id) ON DELETE CASCADE,
    FOREIGN KEY (governante_id) REFERENCES governantes(id) ON DELETE SET NULL
);

-- =========================================================
-- Módulo de Autenticação
-- =========================================================

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    login VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    primeiro_acesso TINYINT(1) NOT NULL DEFAULT 1,
    tentativas_falhas INT NOT NULL DEFAULT 0,
    bloqueado TINYINT(1) NOT NULL DEFAULT 0,
    data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NULL,
    login_tentado VARCHAR(50),
    acao VARCHAR(30) NOT NULL,
    data_hora DATETIME DEFAULT CURRENT_TIMESTAMP,
    ip_address VARCHAR(45),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL
);

-- Usuário administrador padrão (login: admin / senha: admin123)
-- O sistema obrigará a troca desta senha no primeiro acesso.
INSERT INTO usuarios (nome, login, senha, primeiro_acesso) VALUES
('Administrador', 'admin', '$2b$12$JP5uejgiAFAa5MyuT1i25u50EiU9SyufzeFF0tvvhhPJfG/AMIwkS', 1);