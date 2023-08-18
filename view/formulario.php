<?php

session_start();
include_once('../manager/conexao.php');
if ((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    header('Location: ../view/login.php');
}

if (isset($_POST['submit'])) {

    $nome = $_POST['nome'];
    $pu = $_POST['pu'];
    $dataregistro = $_POST['dataregistro'];
    $horaEntrada = $_POST['horaEntrada'];
    $horaSaida = $_POST['horaSaida'];
    $horasExtras = $_POST['horasExtras'];

    $result = mysqli_query($conexao, "INSERT INTO formulario(nome, pu,data_registro, hora_entrada, hora_saida, horas_extras) VALUES('$nome', '$pu','$dataregistro', '$horaEntrada', '$horaSaida', '$horasExtras')");

    if ($result) {
        echo '<script>alert("Dados salvos com sucesso!");</script>';
    } else {
        echo '<script>alert("Erro ao salvar os dados!");</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORMULARIO</title>
    <link rel="stylesheet" type="text/css" href="../style/formulario.css">
</head>

<body>

    <form action="formulario.php" method="post">

        <a href="../view/sistema.php" class="link">Voltar</a>

        <h2>FORMULARIO</h2>

        <div class="form-group">
            <label for="pu"></label><br>
            <input type="text" id="pu" name="pu" placeholder="PU" required>
        </div>
        <br>
        <div class="form-group">
            <label for="nome"></label>
            <input type="text" id="nome" name="nome" placeholder="NOME" required>
        </div>
        <br>
        <div class="form-group">
            <label for="dataregistro">DATA</label>
            <input type="date" id="dataregistro" name="dataregistro" required>
        </div>
        <br>
        <div class="form-group">
            <label for="horaEntrada">Hora de Entrada:</label>
            <input type="time" id="horaEntrada" name="horaEntrada" required>
        </div>
        <br>
        <div class="form-group">
            <label for="horaSaida">Hora de Saída:</label>
            <input type="time" id="horaSaida" name="horaSaida" onchange="calcularHorasExtras()" required>
        </div>
        <br>
        <div class="form-extra">
            <label for="horasExtras">Horas Extras:</label>
            <input type="text" id="horasExtras" name="horasExtras" readonly>
        </div>
        <br>

        <input type="submit" name="submit" id="submit">

    </form>

    <script src="../script/script.js"></script>

</body>

</html>