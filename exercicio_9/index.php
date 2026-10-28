<?php
$nome = $email = $senha = $nascimento = $mensagem = $cidade = $sexo = "";
$interesses = [];
$erros = [];
$enviado = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST["nome"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $senha = $_POST["senha"] ?? "";
    $nascimento = $_POST["nascimento"] ?? "";
    $mensagem = trim($_POST["mensagem"] ?? "");
    $cidade = $_POST["cidade"] ?? "";
    $sexo = $_POST["sexo"] ?? "";
    $interesses = $_POST["interesses"] ?? [];

    if ($nome == "") {
        $erros[] = "Preencha o nome.";
    }

    if ($email == "") {
        $erros[] = "Preencha o e-mail.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "E-mail inválido.";
    }

    if ($senha == "") {
        $erros[] = "Preencha a senha.";
    } elseif (strlen($senha) < 6) {
        $erros[] = "A senha deve ter pelo menos 6 caracteres.";
    }

    if ($nascimento == "") {
        $erros[] = "Preencha a data de nascimento.";
    }

    if ($mensagem == "") {
        $erros[] = "Preencha a mensagem.";
    }

    if ($cidade == "") {
        $erros[] = "Escolha uma cidade.";
    }

    if ($sexo == "") {
        $erros[] = "Escolha o sexo.";
    }

    if (count($interesses) == 0) {
        $erros[] = "Escolha pelo menos um interesse.";
    }

    $enviado = count($erros) == 0;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Exercício 9 - Formulário</title>

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

        .erro {
            color: red;
        }

        .sucesso {
            background-color: #e0ffe0;
            padding: 15px;
            border-radius: 5px;
        }
    </style>
</head>

<body>

<div class="container">

    <p><a href="index.php">Formulário</a> | <a href="login.php">Login</a> | <a href="cifrar.php">Cifrar senha</a></p>

    <h1>Formulário</h1>

    <?php if ($enviado) { ?>
        <div class="sucesso">
            <h2>Dados enviados com sucesso!</h2>
            <p>Nome: <?php echo htmlspecialchars($nome); ?></p>
            <p>E-mail: <?php echo htmlspecialchars($email); ?></p>
            <p>Senha: <?php echo str_repeat("*", strlen($senha)); ?></p>
            <p>Data de nascimento: <?php echo date("d/m/Y", strtotime($nascimento)); ?></p>
            <p>Mensagem: <?php echo htmlspecialchars($mensagem); ?></p>
            <p>Cidade: <?php echo htmlspecialchars($cidade); ?></p>
            <p>Sexo: <?php echo htmlspecialchars($sexo); ?></p>
            <p>Interesses: <?php echo htmlspecialchars(implode(", ", $interesses)); ?></p>
        </div>
    <?php } else { ?>

        <?php foreach ($erros as $erro) { ?>
            <p class="erro"><?php echo $erro; ?></p>
        <?php } ?>

        <form method="post" action="index.php">
            <label>Nome:</label>
            <input type="text" name="nome" value="<?php echo htmlspecialchars($nome); ?>">

            <label>E-mail:</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">

            <label>Senha:</label>
            <input type="password" name="senha">

            <label>Data de nascimento:</label>
            <input type="date" name="nascimento" value="<?php echo htmlspecialchars($nascimento); ?>">

            <label>Mensagem:</label>
            <textarea name="mensagem" rows="4" cols="40"><?php echo htmlspecialchars($mensagem); ?></textarea>

            <label>Cidade:</label>
            <select name="cidade">
                <option value="">Selecione</option>
                <option value="Porto Alegre" <?php if ($cidade == "Porto Alegre") echo "selected"; ?>>Porto Alegre</option>
                <option value="São Paulo" <?php if ($cidade == "São Paulo") echo "selected"; ?>>São Paulo</option>
                <option value="Rio de Janeiro" <?php if ($cidade == "Rio de Janeiro") echo "selected"; ?>>Rio de Janeiro</option>
            </select>

            <label>Sexo:</label>
            <input type="radio" name="sexo" value="Masculino" <?php if ($sexo == "Masculino") echo "checked"; ?>> Masculino
            <input type="radio" name="sexo" value="Feminino" <?php if ($sexo == "Feminino") echo "checked"; ?>> Feminino
            <input type="radio" name="sexo" value="Outro" <?php if ($sexo == "Outro") echo "checked"; ?>> Outro

            <label>Interesses:</label>
            <input type="checkbox" name="interesses[]" value="Esportes" <?php if (in_array("Esportes", $interesses)) echo "checked"; ?>> Esportes
            <input type="checkbox" name="interesses[]" value="Música" <?php if (in_array("Música", $interesses)) echo "checked"; ?>> Música
            <input type="checkbox" name="interesses[]" value="Tecnologia" <?php if (in_array("Tecnologia", $interesses)) echo "checked"; ?>> Tecnologia

            <br><br>
            <input type="submit" value="Enviar">
            <input type="reset" value="Limpar">
        </form>

    <?php } ?>

</div>

</body>
</html>
