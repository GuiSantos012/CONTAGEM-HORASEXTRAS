<?php

include_once('../manager/conexao.php');

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $pu = $_POST['pu'];
    $dataregistro = $_POST['dataregistro'];
    $horaPositivo = $_POST['horapositivo'];
    $horaNegativo = $_POST['horanegativo'];
    $observacao = $_POST['observacao'];

    $sqlupdate = "UPDATE registros_dados SET nome='$nome', pu='$pu', data_registro='$dataregistro', hora_positivo='$horaPositivo', hora_negativo='$horaNegativo', observacao='$observacao' where id='$id'";

    $result = $conexao->query($sqlupdate);
}

header('location: ../view/sistema.php');
