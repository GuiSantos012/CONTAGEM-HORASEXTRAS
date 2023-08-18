<?php

if (!empty($_GET['id'])) {

    include_once('../manager/conexao.php');

    $id = $_GET['id'];

    $sqlselect = "Select * from funcionarios where id=$id";

    $result = $conexao->query($sqlselect);

    if ($result->num_rows > 0) {
        $sqldelete = "DELETE FROM funcionarios where id=$id";
        $resultdelete = $conexao->query($sqldelete);
    }
}

header('location: ../view/cadastro.php');
