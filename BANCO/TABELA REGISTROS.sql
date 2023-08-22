CREATE TABLE registros_dados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pu VARCHAR(15) NOT NULL,
    nome VARCHAR(100) NOT NULL,
    data_registro date,
    hora_positivo time,
    hora_negativo time
);

SELECT * FROM empresa_db.registros_dados;

SELECT 
	pu,
    nome,
	SEC_TO_TIME(
    TIME_TO_SEC(SUM(hora_positivo)) - TIME_TO_SEC(SUM(hora_negativo))
) AS resultado
FROM registros_dados
group by pu;
