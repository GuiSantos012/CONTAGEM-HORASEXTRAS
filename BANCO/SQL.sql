CREATE DATABASE empresa_db;

USE empresa_db;

CREATE TABLE formulario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    pu VARCHAR(5) NOT NULL,
    hora_entrada TIME NOT NULL,
    hora_saida TIME NOT NULL,
    horas_extras TIME NOT NULL
);

    
