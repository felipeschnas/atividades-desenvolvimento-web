<?php
$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST["usuario"] ?? "");
    $senha = trim($_POST["senha"] ?? "");

    if ($usuario == "" || $senha == "") {
        $resultado = "Preencha usuário e senha.";
    } else {
        $linhas = file("autenticacao.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $resultado = "Usuário ou senha incorretos.";

        foreach ($linhas as $linha) {
            list($u, $s) = explode(";", trim($linha));

            if ($u == $usuario && $s == $senha) {
                $resultado = "Login realizado com sucesso! Bem-vindo, " . htmlspecialchars($usuario) . ".";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Exercício 9 - Login</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 40px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }

        label {
            display: block;
            margin-top: 10px;
        }
    </style>
</head>

<body>

<div class="container">

    <p><a href="index.php">Formulário</a> | <a href="login.php">Login</a> | <a href="cifrar.php">Cifrar senha</a></p>

    <h1>Login</h1>

    <p><strong><?php echo $resultado; ?></strong></p>

    <form method="post" action="login.php">
        <label>Usuário:</label>
        <input type="text" name="usuario">

        <label>Senha:</label>
        <input type="password" name="senha">

        <br><br>
        <input type="submit" value="Entrar">
    </form>

</div>

</body>
</html>
