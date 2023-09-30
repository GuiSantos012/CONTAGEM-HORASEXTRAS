<?php
session_start();

// ...

if (isset($_SESSION['mensagem_erro'])) {
    echo '<div style="position: fixed; z-index: 3; left: 50%; top:23%; transform: translateX(-50%); background-color: #ff9999; padding: 10px; border-radius: 5px; text-align: center; color: red;">' . $_SESSION['mensagem_erro'] . '</div>';
    unset($_SESSION['mensagem_erro']); // Limpa a mensagem após exibi-la
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="../style/login.css">
</head>

<body>

    <div class="login">
        <h1>Login</h1>
        <form action="../manager/testelogin.php" method="POST">
            <input type="text" name="login" placeholder="Login">
            <br><br>
            <input type="password" name="senha" placeholder="Senha">
            <br><br>
            <input class="inputSubmit" type="submit" name="submit" value="Enviar">
        </form>
    </div>

</body>

</html>