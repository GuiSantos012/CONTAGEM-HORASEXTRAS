<?php

session_start();
include_once('../manager/conexao.php');
// print_r($_SESSION);
if ((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    header('Location: ../view/login.php');
}

if (isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $pu = $_POST['pu'];

    // Consulta SQL para verificar se o PU já existe no banco de dados
    $sql_check = "SELECT * FROM funcionarios WHERE pu = '$pu'";
    $result_check = $conexao->query($sql_check);

    if ($result_check->num_rows > 0) {
        // O PU já existe no banco de dados, exiba uma mensagem de erro
        echo '<script>alert("PU já cadastrado. Por favor, escolha outro PU.");</script>';
    } else {
        // O PU não existe no banco de dados, insira os dados
        $sql_insert = "INSERT INTO funcionarios(nome, pu) VALUES('$nome', '$pu')";
        if ($conexao->query($sql_insert) === TRUE) {
            echo '<script>alert("Dados salvos com sucesso!");</script>';
        } else {
            echo '<script>alert("Erro ao salvar os dados!");</script>';
        }
    }
}

$sqllista = "Select * From funcionarios order by pu";

$result = $conexao->query($sqllista);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style/cadastro.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>CADASTRO</title>
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

    <form action="cadastro.php" method="post">

        <h2>REGISTRAR FUNCIONARIO</h2>
        <br>
        <div class="form-group">
            <label for="pu"></label>
            <input type="text" id="pu" name="pu" placeholder="PU" required>
        </div>
        <br>
        <div class="form-group">
            <label for="nome"></label>
            <input type="text" id="nome" name="nome" placeholder="NOME" required>
        </div>
        <br>

        <input type="submit" name="submit" id="submit">

    </form>


    <div class="m-5">

        <table class="table text-white table-">
            <thead>
                <tr>
                    <th scope="col">PU</th>
                    <th scope="col">NOME</th>
                    <th scope="col">...</th>
                </tr>
            </thead>
            <tbody>

                <?php
                while ($user_data = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $user_data["pu"] . "</td>";
                    echo "<td>" . $user_data["nome"] . "</td>";
                    echo "<td>
                    <a class = 'btn btn-sm btn-danger border border-dark' href = '../manager/deletecad.php?id=$user_data[id]'> 
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                            <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z'/>
                            <path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z'/>
                            </svg>
                    </a>


                    </td>";
                }
                ?>

            </tbody>
        </table>
    </div>



</body>

</html>