CREATE DATABASE db_mundo;
USE db_mundo;

CREATE TABLE continente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    populacao BIGINT,
    area_km2 DECIMAL(12,2),
    total_paises INT DEFAULT 0
);

CREATE TABLE governante (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    partido_politico VARCHAR(100),
    data_nascimento DATE,
    idade INT,
    data_inicio_mandato DATE,
    data_fim_mandato DATE
);

CREATE TABLE pais (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    continente_id INT,
    populacao BIGINT,
    area_km2 DECIMAL(12,2),
    idioma VARCHAR(100),
    governante_id INT,
    clima VARCHAR(100),
    regime_politico VARCHAR(100),
    moeda VARCHAR(50),
    FOREIGN KEY (continente_id) REFERENCES continente(id) ON DELETE RESTRICT,
    FOREIGN KEY (governante_id) REFERENCES governante(id) ON DELETE SET NULL
);

CREATE TABLE cidade (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    pais_id INT NOT NULL,
    populacao BIGINT,
    area_km2 DECIMAL(12,2),
    clima VARCHAR(100),
    governante_id INT,
    data_fundacao DATE,
    FOREIGN KEY (pais_id) REFERENCES pais(id) ON DELETE CASCADE, 
    FOREIGN KEY (governante_id) REFERENCES governante(id) ON DELETE SET NULL
);
