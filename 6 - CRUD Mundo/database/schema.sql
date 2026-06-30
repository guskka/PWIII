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