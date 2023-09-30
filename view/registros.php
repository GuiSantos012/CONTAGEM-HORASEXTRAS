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
    $sql = "SELECT pu, nome, SEC_TO_TIME(SUM(TIME_TO_SEC(hora_positivo)) - SUM(TIME_TO_SEC(hora_negativo))) AS saldo_total FROM registros_dados WHERE pu LIKE '%$data%' OR nome LIKE '%$data%' GROUP BY nome";
} else {
    $sql = "SELECT pu, nome, SEC_TO_TIME(SUM(TIME_TO_SEC(hora_positivo)) - SUM(TIME_TO_SEC(hora_negativo))) AS saldo_total FROM registros_dados GROUP BY nome";
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
    <br>

    <div class="box-search">
        <input type="search" class="form-control w-25 border border-dark" placeholder="Pesquisar" id="pesquisar">
        <button onclick="searchdata()" class="btn btn-primary border border-dark">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
            </svg>
        </button>

        <a href="../manager/gerarpdf.php" target="_blank">
            <button class="btn btn-danger border border-dark">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                </svg>
            </button>
        </a>
    </div>

    <script src="../script/pesqregi.js"></script>
    <br>

    <div class="m-5">
        <table class="table text-white table-bg">
            <thead>
                <tr>
                    <th scope="col">NOME</th>
                    <th scope="col">PU</th>
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
                            echo "<td>" . $user_data["nome"] . "</td>";
                            echo "<td>" . $user_data["pu"] . "</td>";

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