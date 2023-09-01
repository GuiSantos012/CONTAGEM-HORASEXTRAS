<?php

if (!empty($_GET['id'])) {

    include_once('../manager/conexao.php');

    $id = $_GET['id'];

    $sqlselect = "Select * from registros_dados where id=$id";

    $result = $conexao->query($sqlselect);

    if ($result->num_rows > 0) {
        while ($user_data = mysqli_fetch_assoc($result)) {
            $nome = $user_data['nome'];
            $pu = $user_data['pu'];
            $dataregistro = $user_data['data_registro'];
            $horapositivo = $user_data['hora_positivo'];
            $horanegativo = $user_data['hora_negativo'];
            $observacao = $user_data['observacao'];
        }
    } else {
        header('location: ../view/sistema.php');
    }
} else {
    header('location: ../view/sistema.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORMULARIO</title>
    <link rel="stylesheet" type="text/css" href="../style/edit.css">
</head>

<body>

    <form action="../manager/saveedit.php" method="post">

        <a href="../view/sistema.php" class="link">Voltar</a>

        <h2>ATUALIZAR HORAS</h2>
        <br>
        <div class="form-group">
            <label for="pu"></label>
            <input type="text" id="pu" name="pu" placeholder="PU" value="<?php echo $pu ?>" required>
        </div>
        <br>
        <div class="form-group">
            <label for="nome"></label>
            <input type="text" id="nome" name="nome" placeholder="NOME" value="<?php echo $nome ?>" required>
        </div>
        <br>
        <div class="form-group">
            <h6 for="dataregistro">DATA:</h6>
            <input type="date" id="dataregistro" name="dataregistro" value="<?php echo $dataregistro ?>" required>
        </div>

        <div class="form-group">
            <h6 for="horapositivo">Hora Positivo:</h6>
            <input type="time" id="horapositivo" name="horapositivo" value="<?php echo $horapositivo ?>" required>
        </div>

        <div class="form-group">
            <h6 for="horanegativo">Hora Negativo:</h6>
            <input type="time" id="horanegativo" name="horanegativo" value="<?php echo $horanegativo ?>" required>
        </div>

        <div class="form-group">
            <h6 for="observacao">Observação:</h6>
            <input type="text" id="observacao" name="observacao" value="<?php echo $observacao ?>">
        </div>
        <br>
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <input type="submit" name="update" id="update">

    </form>


</body>

</html>