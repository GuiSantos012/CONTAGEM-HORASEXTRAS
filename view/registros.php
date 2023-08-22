<?php

session_start();
include_once('../manager/conexao.php');

if ((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    header('Location: ../view/login.php');
}


// Consulta para somar os valores das colunas horas_positivas e horas_negativas e recuperar pu e nome
$sql = "SELECT pu, nome, SUM(TIME_TO_SEC(hora_positivo)) AS total_positivas, SUM(TIME_TO_SEC(hora_negativo)) AS total_negativas FROM registros_dados GROUP BY pu";
$result = $conexao->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style/sistema.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>REGISTROS</title>
</head>

<body>

    <header>
        <nav class="nav-bar">
            <div class="logo">
                <h1>SISTEMA</h1>
            </div>

            <div class="nav-list">
                <ul>
                    <li class="nav-item"><a href="../view/cadastro.php" class="nav-link">CADASTRO</a></li>
                    <li class="nav-item"><a href="../view/dados.php" class="nav-link">DADOS</a></li>
                    <li class="nav-item"><a href="../view/sistema.php" class="nav-link">SISTEMA</a></li>
                    <li class="nav-item"><a href="../view/registros.php" class="nav-link">REGISTRO</a></li>
                </ul>
            </div>

            <div class="sair-button">
                <button><a href="../manager/sair.php">SAIR</a></button>
            </div>
        </nav>
    </header>
    <br>



    <script src="../script/pesqregi.js"></script>

    <div class="m-5">
        <table class="table text-white table-bg">
            <thead>
                <tr>
                    <th scope="col">PU</th>
                    <th scope="col">NOME</th>
                    <th scope="col">SALDO</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if ($result->num_rows > 0) {
                    while ($user_data = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $user_data["pu"] . "</td>";
                        echo "<td>" . $user_data["nome"] . "</td>";

                        $saldo = $user_data["total_positivas"] - $user_data["total_negativas"];

                        echo "<td>";

                        if ($saldo < 0) {
                            echo "-";
                        }

                        echo gmdate('H:i', abs($saldo)) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<td>" . $saldo . "</td>";
                    echo "</tr>";
                }

                ?>

            </tbody>
        </table>
    </div>


</body>

</html>