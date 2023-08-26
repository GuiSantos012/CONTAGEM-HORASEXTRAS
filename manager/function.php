<?php

include_once('../manager/conexao.php');

// Obter o valor passado via parâmetro GET
$valorPU = $_GET['pu'];

// Preparar a consulta SQL para evitar injeção de SQL
$stmt = $conexao->prepare("SELECT nome FROM funcionarios WHERE pu = ?");
$stmt->bind_param("s", $valorPU);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row["nome"];
} else {
    echo "Nome não encontrado";
}
