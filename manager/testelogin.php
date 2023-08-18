<?php
session_start();
// print_r($_REQUEST);
if (isset($_POST['submit']) && !empty($_POST['login']) && !empty($_POST['senha'])) {
    // Acessa
    include_once('../manager/conexao.php');
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    // print_r('Email: ' . $email);
    // print_r('<br>');
    // print_r('Senha: ' . $senha);

    $sql = "SELECT * FROM usuarios WHERE users = '$login' and senha = '$senha'";

    $result = $conexao->query($sql);

    // print_r($sql);
    // print_r($result);

    if (mysqli_num_rows($result) < 1) {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('Location: ../view/login.php');
    } else {
        $_SESSION['login'] = $login;
        $_SESSION['senha'] = $senha;
        header('Location: ../view/sistema.php');
    }
} else {
    // Não acessa
    header('Location: ../view/login.php');
}
