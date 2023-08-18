CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    users VARCHAR(15) NOT NULL,
    senha VARCHAR(10) NOT NULL
);

insert into usuarios (users, senha) values ('admin', 'admin');

delete TABLE funcionarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    pu VARCHAR(5) NOT NULL,
    UNIQUE KEY unique_pu (pu)
);

SELECT * FROM empresa_db.funcionarios;
    

    
