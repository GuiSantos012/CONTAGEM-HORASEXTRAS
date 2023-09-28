<?php

session_start();
include_once('../manager/conexao.php');
// print_r($_SESSION);
if ((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    header('Location: ../view/login.php');
}
$logado = $_SESSION['login'];

if (!empty($_GET['search'])) {
    $data = $_GET['search'];
    $sql = "SELECT *, DATE_FORMAT(data_registro, '%d/%m/%Y') AS data_formatada FROM registros_dados WHERE pu LIKE '%$data%' OR nome LIKE '%$data%' ORDER BY pu";
} else {
    $sql = "SELECT *, DATE_FORMAT(data_registro, '%d/%m/%Y') AS data_formatada FROM registros_dados ORDER BY pu";
}

$result = $conexao->query($sql);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style/sistema.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>SISTEMA</title>
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
    </div>

    <script src="../script/pesquisar.js"></script>

    <div class="m-5">
        <table class="table text-white table-bg">
            <thead>
                <tr>
                    <th scope="col">PU</th>
                    <th scope="col">NOME</th>
                    <th scope="col">DATA</th>
                    <th scope="col">HORA POSITIVO</th>
                    <th scope="col">HORA NEGATIVO</th>
                    <th scope="col">OBSERVAÇÃO</th>
                    <th scope="col">...</th>
                </tr>
            </thead>
            <tbody>

                <?php
                while ($user_data = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $user_data["pu"] . "</td>";
                    echo "<td>" . $user_data["nome"] . "</td>";
                    echo "<td>" . $user_data["data_formatada"] . "</td>";
                    // Formata a coluna "hora_positivo"
                    $horaPositivoSegundos = strtotime($user_data["hora_positivo"]);
                    $horaPositivoFormatada = date("H:i", $horaPositivoSegundos);
                    echo "<td>" . $horaPositivoFormatada . "</td>";

                    // Formata a coluna "hora_negativo"
                    $horaNegativoSegundos = strtotime($user_data["hora_negativo"]);
                    $horaNegativoFormatada = date("H:i", $horaNegativoSegundos);
                    echo "<td>" . $horaNegativoFormatada . "</td>";

                    $observacao = $user_data["observacao"];
                    if (!empty($observacao)) {
                        echo "<td><button class='observacao-button' data-observacao='" . htmlspecialchars($observacao) . "'>Ver Observação</button></td>";
                    } else {
                        echo "<td></td>"; // Se não houver observação, coloca uma célula vazia
                    }


                    echo "<td>
                        <a class = 'btn btn-sm btn-primary border border-dark' href = '../view/edit.php?id=$user_data[id]'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                                </svg>
                        </a>
                        <a class = 'btn btn-sm btn-danger border border-dark' href=\"javascript:confirmarDelecao({$user_data['id']});\"> 
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                                <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z'/>
                                <path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z'/>
                                </svg>
                        </a>


                    </td>";
                }
                ?>

                <script>
                    function confirmarDelecao(userId) {
                        // Exibir uma caixa de diálogo de confirmação
                        var confirmacao = window.confirm("Tem certeza de que deseja deletar este item?");

                        // Verificar a resposta do usuário
                        if (confirmacao) {
                            // Se o usuário confirmar, redirecione para a página de exclusão com o ID do usuário
                            window.location.href = "../manager/delete.php?id=" + userId;
                        } else {
                            // Se o usuário cancelar, não faça nada
                        }
                    }
                </script>



            </tbody>
        </table>
        <div id="observacao-modal" class="modal">
            <div class="modal-content" id="observacao-content"></div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const buttons = document.querySelectorAll(".observacao-button");
                const modal = document.getElementById("observacao-modal");
                const modalContent = document.getElementById("observacao-content");

                buttons.forEach(button => {
                    button.addEventListener("click", function() {
                        const observacao = this.getAttribute("data-observacao");

                        // Verificar se a observação está vazia
                        if (observacao.trim() !== "") {
                            modalContent.innerHTML = observacao;
                            modal.style.display = "block"; // Mostrar o modal
                        } else {
                            console.log("Observação vazia, não exibindo o modal.");
                        }
                    });
                });

                window.addEventListener("click", function(event) {
                    if (event.target === modal) {
                        modal.style.display = "none";
                    }
                });
            });
        </script>


    </div>

</body>

</html>