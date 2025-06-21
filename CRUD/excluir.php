<?php
include("conexao.php");

if (!isset($_GET["id"])) {
    die("ID não informado.");
}

$id = base64_decode($_GET["id"]);

if (!is_numeric($id)) {
    die("ID inválido.");
}

// Buscar os dados do item
$sql = "SELECT * FROM brinquedos WHERE id = $id";
$result = mysqli_query($conexao, $sql);

if (mysqli_num_rows($result) == 0) {
    die("Produto não encontrado.");
}

$dados = mysqli_fetch_assoc($result);

// Se confirmação foi enviada (via POST)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirm"]) && $_POST["confirm"] == "sim") {
    // Deletar a imagem se existir
    if (!empty($dados["foto"])) {
        $arquivo = "imagens/" . $dados["foto"];
        if (file_exists($arquivo)) {
            unlink($arquivo);
        }
    }

    // Executar o DELETE no banco
    $sqldelete = "DELETE FROM brinquedos WHERE id = $id";
    mysqli_query($conexao, $sqldelete);

    mysqli_close($conexao);

    // Redireciona após excluir
    header("Location: index.php?msg=excluido");
    exit();
}

mysqli_close($conexao);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Exclusão</title>
    <link rel="stylesheet" href="css/excluir.css">
</head>
<body>

<div class="container">
    <h2>Confirmação de Exclusão</h2>
    <p><b>Tem certeza que deseja excluir este brinquedo?</b></p>
    <p>
        <b>ID:</b> <?php echo $dados['id']; ?><br>
        <b>Modelo:</b> <?php echo htmlspecialchars($dados['modelo']); ?><br>
        <b>Marca:</b> <?php echo htmlspecialchars($dados['marca']); ?><br>
        <b>Faixa Etária:</b> <?php echo $dados['faixaetaria']; ?> anos<br>
    </p>

    <!-- Exibir a imagem do produto -->
    <div class="produto-imagem">
        <img src="imagens/<?php echo !empty($dados['foto']) ? $dados['foto'] : 'semimagem.png'; ?>" alt="Imagem do produto" width="200px">
    </div>

    <form method="post">
        <input type="hidden" name="confirm" value="sim">
        <button type="submit" class="btn btn-confirm">Confirmar Exclusão</button>
        <button type="button" class="btn btn-cancel" onclick="window.location='index.php'">Cancelar</button>
    </form>
</div>

</body>
</html>
