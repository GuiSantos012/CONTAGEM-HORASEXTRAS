<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['login']) && !empty($_POST['senha'])) {
    include_once('../manager/conexao.php');
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE users = '$login' and senha = '$senha'";
    $result = $conexao->query($sql);

    if (mysqli_num_rows($result) < 1) {
        $_SESSION['mensagem_erro'] = 'Login ou senha incorretos. Tente novamente.';
        header('Location: ../view/login.php');
    } else {
        $_SESSION['login'] = $login;
        $_SESSION['senha'] = $senha;
        header('Location: ../view/sistema.php');
    }
} else {
    $_SESSION['mensagem_erro'] = 'Por favor, preencha todos os campos.';
    header('Location: ../view/login.php');
}
