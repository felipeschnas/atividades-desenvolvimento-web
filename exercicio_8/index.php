<?php
// EXER 1.

date_default_timezone_set("America/Sao_Paulo");

$dataHora = date("d/m/Y H:i");

// EWXER 2.

function criarMensagem($nome)
{
    $nome = strtoupper($nome);

    return "Olá, $nome! bem vindo.";
}

$linguagens = ["PHP", "JavaScript", "HTML", "CSS"];

$listaLinguagens = implode(", ", $linguagens);

$mensagem = criarMensagem("Aluno");

// EXER 3.

$arquivo = "visitas.txt";

if (!file_exists($arquivo)) {
    file_put_contents($arquivo, "0");
}

$visitas = (int) file_get_contents($arquivo);

$visitas++;

file_put_contents($arquivo, $visitas);

// EXER 4. 

session_start();

if (!isset($_SESSION["usuario"])) {
    $_SESSION["usuario"] = "Aluno";
}

$usuario = $_SESSION["usuario"];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Exemplo PHP</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 40px;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }

        h1 {
            color: #333;
        }

        .item {
            padding: 15px;
            margin: 10px 0;
            background-color: #eeeeee;
            border-radius: 5px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>1 Exer</h1>

    <div class="item">
        <h2>1. Data</h2>

        <p>
            <?php echo date("d/m/Y"); ?>
            horario <?php echo date("H:i"); ?>h
        </p>
    </div>

    <div class="item">
        <h2>2 Exer</h2>

        <p>
            <?php echo $mensagem; ?>
        </p>

        <p>
            Linguagens :
            <?php echo $listaLinguagens; ?>
        </p>
    </div>

    <div class="item">
        <h2>3 Exrt</h2>

        <p>
            Esta página foi visitada
            <strong><?php echo $visitas; ?></strong>
            vezes.
        </p>
    </div>

    <!-- 4. Session -->
    <div class="item">
        <h2>4 Exer</h2>

        <p>
            Usuário armazenado na sessão:
            <strong><?php echo $usuario; ?></strong>
        </p>
    </div>

</div>

</body>
</html>
