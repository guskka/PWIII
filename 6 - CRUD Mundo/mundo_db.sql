CREATE DATABASE IF NOT EXISTS bd_mundo;
USE bd_mundo;

CREATE TABLE continentes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    populacao BIGINT,
    area_km2 DECIMAL(12,2),
    total_paises INT DEFAULT 0
);

CREATE TABLE governantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    partido_politico VARCHAR(100),
    data_nascimento DATE,
    idade INT,
    data_inicio_mandato DATE,
    data_fim_mandato DATE
);

CREATE TABLE paises (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    continente_id INT,
    populacao BIGINT,
    area_km2 DECIMAL(12,2),
    idioma VARCHAR(50),
    governante_id INT,
    clima VARCHAR(50),
    regime_politico VARCHAR(50),
    moeda VARCHAR(30),
    FOREIGN KEY (continente_id) REFERENCES continentes(id) ON DELETE RESTRICT,
    FOREIGN KEY (governante_id) REFERENCES governantes(id) ON DELETE SET NULL
);

CREATE TABLE cidades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    pais_id INT NOT NULL,
    populacao BIGINT,
    area_km2 DECIMAL(12,2),
    clima VARCHAR(50),
    governante_id INT,
    data_fundacao DATE,
    FOREIGN KEY (pais_id) REFERENCES paises(id) ON DELETE CASCADE,
    FOREIGN KEY (governante_id) REFERENCES governantes(id) ON DELETE SET NULL
);
