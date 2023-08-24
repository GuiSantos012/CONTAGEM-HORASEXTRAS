<?php

session_start();
include_once('../manager/conexao.php');

if ((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    header('Location: ../view/login.php');
}

if (!empty($_GET['search'])) {
    $data = $_GET['search'];
    $sql = "SELECT pu, nome, SUM(TIME_TO_SEC(hora_positivo)) AS total_positivas, SUM(TIME_TO_SEC(hora_negativo)) AS total_negativas FROM registros_dados WHERE pu LIKE '%$data%' OR nome LIKE '%$data%' GROUP BY nome";
} else {
    $sql = "SELECT pu, nome, SEC_TO_TIME(SUM(TIME_TO_SEC(hora_positivo)) - SUM(TIME_TO_SEC(hora_negativo))) AS saldo_total FROM registros_dados GROUP BY pu";
}
// Consulta para somar os valores das colunas horas_positivas e horas_negativas e recuperar pu e nome

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

    <div class="box-search">
        <input type="search" class="form-control w-25 border border-dark" placeholder="Pesquisar" id="pesquisar">
        <button onclick="searchdata()" class="btn btn-primary border border-dark">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
            </svg>
        </button>
    </div>

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
                        $saldo_total = $user_data["saldo_total"];

                        if ($saldo_total != "00:00:00") {
                            echo "<tr>";
                            echo "<td>" . $user_data["pu"] . "</td>";
                            echo "<td>" . $user_data["nome"] . "</td>";

                            echo "<td>" . $saldo_total . "</td>";
                            echo "<tr>";
                        }
                    }
                }
                ?>

            </tbody>
        </table>
    </div>

</body>

</html>