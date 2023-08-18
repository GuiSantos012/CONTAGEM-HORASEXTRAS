<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="../style/login.css">
</head>

<body>

    <div>
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