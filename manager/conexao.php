<?php

$dbhost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'empresa_db';


$conexao = new mysqli($dbhost, $dbUsername, $dbPassword, $dbName);

/*
if ($conexao->connect_errno) {
    echo "Não foi possível realizar a conexão!!";
} else {
    echo "Conexão realizada com sucesso";
}
*/