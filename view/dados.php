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
    $horapositivo = $_POST['horapositivo'];
    $horanegativo = $_POST['horanegativo'];
    $observacao = $_POST['observacao'];

    // Usando declaração preparada para inserir dados seguramente
    $stmt = $conexao->prepare("INSERT INTO registros_dados (pu, nome, data_registro, hora_positivo, hora_negativo, observacao) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $pu, $nome, $dataregistro, $horapositivo, $horanegativo, $observacao);

    if ($stmt->execute()) {
        echo '<script>alert("Dados salvos com sucesso!");</script>';
    } else {
        echo '<script>alert("Erro ao salvar os dados!");</script>';
    }
}

$sql_codes_states = "Select * From funcionarios order by pu";
$sql_query_states = $conexao->query($sql_codes_states) or die($conexao->error)

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style/dados.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>DADOS</title>
</head>

<body>

    <header>
        <nav class="nav-bar">
            <div class="logo">
                <h1>BH</h1>
            </div>

            <div class="nav-list">
                <ul>
                    <li class="nav-item"><a href="../view/cadastro.php" class="nav-link">CADASTRO</a></li>
                    <li class="nav-item"><a href="../view/dados.php" class="nav-link">REGISTRAR</a></li>
                    <li class="nav-item"><a href="../view/sistema.php" class="nav-link">SISTEMA</a></li>
                    <li class="nav-item"><a href="../view/registros.php" class="nav-link">DADOS</a></li>
                </ul>
            </div>

            <div class="sair-button">
                <button><a href="../manager/sair.php">SAIR</a></button>
            </div>
        </nav>
    </header>

    <form action="dados.php" method="post">

        <h2>REGISTRAR HORAS</h2>
        <br>
        <select <?php if (isset($_GET['pu'])) echo "Disabled"; ?> required name="pu" id="pu">
            <option value="">Selecione um PU</option>
            <?php while ($pu = $sql_query_states->fetch_assoc()) { ?>
                <option <?php if (isset($_GET['pu']) && $_GET['pu'] == $pu['pu']) echo "Selected"; ?> value="<?php echo $pu['pu']; ?> "> <?php echo $pu['pu']; ?> </option>
            <?php } ?>
        </select>
        <br><br>

        <div class="form-group">
            <label for="nome"></label>
            <input type="text" id="nome" name="nome" placeholder="NOME" required>
        </div>

        <script src="../script/preencher.js"></script>

        <div class="form-group">
            <h6 for="dataregistro">DATA:</h6>
            <input type="date" id="dataregistro" name="dataregistro" required>
        </div>

        <div class="form-group">
            <h6 for="horapositivo">Hora Positivo:</h6>
            <input type="time" id="horapositivo" name="horapositivo" required>
        </div>

        <div class="form-group">
            <h6 for="horanegativo">Hora Negativo:</h6>
            <input type="time" id="horanegativo" name="horanegativo" required>
        </div>

        <div class="form-group">
            <h6 for="observacao">Observação:</h6>
            <input type="text" id="observacao" name="observacao">
        </div>
        <br>
        <input type="submit" name="submit" id="submit">

    </form>


</body>

</html>