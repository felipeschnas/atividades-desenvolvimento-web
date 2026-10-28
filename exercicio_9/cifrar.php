<?php
$senha = "";
$hash = "";
$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $senha = $_POST["senha"] ?? "";
    $hash = $_POST["hash"] ?? "";

    if (isset($_POST["cifrar"]) && $senha != "") {
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $resultado = "Senha cifrada com sucesso!";
    }

    if (isset($_POST["validar"]) && $senha != "" && $hash != "") {
        if (password_verify($senha, $hash)) {
            $resultado = "Senha correta!";
        } else {
            $resultado = "Senha incorreta!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Exercício 9 - Cifrar senha</title>

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

    <h1>Cifrar e validar senha</h1>

    <p>Usando as funções <code>password_hash()</code> e <code>password_verify()</code> do PHP.</p>

    <p><strong><?php echo $resultado; ?></strong></p>

    <form method="post" action="cifrar.php">
        <label>Senha:</label>
        <input type="text" name="senha">

        <label>Hash:</label>
        <input type="text" name="hash" size="70" value="<?php echo htmlspecialchars($hash); ?>">

        <br><br>
        <input type="submit" name="cifrar" value="Cifrar">
        <input type="submit" name="validar" value="Validar">
    </form>

</div>

</body>
</html>
