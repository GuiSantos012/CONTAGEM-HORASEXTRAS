<?php

if (!empty($_GET['id'])) {

    include_once('../manager/conexao.php');

    $id = $_GET['id'];

    $sqlselect = "Select * from registros_dados where id=$id";

    $result = $conexao->query($sqlselect);

    if ($result->num_rows > 0) {
        $sqldelete = "DELETE FROM registros_dados where id=$id";
        $resultdelete = $conexao->query($sqldelete);
    }
}

header('location: ../view/sistema.php');
