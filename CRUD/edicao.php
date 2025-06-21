<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alteração de Brinquedo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/edicao.css">
</head>
<body>

<div class="navbar">
    <a href="index.php" class="botao-voltar">Voltar</a>
    <h3>Alteração de Brinquedo</h3>
</div>

<?php
try {
    include("conexao.php");

    if (!isset($_GET["id"])) {
        throw new Exception("ID não informado.");
    }

    $id = base64_decode($_GET["id"]);

    if (!is_numeric($id)) {
        throw new Exception("ID inválido.");
    }

    // Consultar os dados
    $sql = "SELECT * FROM brinquedos WHERE id = $id";
    $result = mysqli_query($conexao, $sql);

    if (!$result) {
        throw new Exception("Erro na consulta: " . mysqli_error($conexao));
    }

    if (mysqli_num_rows($result) == 0) {
        echo "<h4>Produto não encontrado.</h4>";
        echo "<br><button onclick=\"window.location='index.php';\">Voltar</button>";
        exit();
    }

    $dados = mysqli_fetch_assoc($result);

    mysqli_close($conexao);

    // Formatar data para datetime-local
    $datacad = date('Y-m-d\TH:i', strtotime($dados['datacad']));

} catch (Exception $e) {
    echo "<h4 class='erro'>Ocorreu um erro: <br>" . $e->getMessage() . "</h4>";
    echo "<br><button onclick=\"window.location='index.php';\">Voltar</button>";
    exit();
}
?>

<form action="editar.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $dados['id']; ?>">

    <div class="campo">
        <label for="codigo">Código:</label>
        <input type="number" name="codigo" id="codigo" value="<?= $dados['codigo']; ?>" required>
    </div>

    <div class="campo">
        <label for="modelo">Modelo:</label>
        <input type="text" name="modelo" id="modelo" maxlength="50" value="<?= $dados['modelo']; ?>" required>
    </div>

    <div class="campo">
        <label for="marca">Marca:</label>
        <input type="text" name="marca" id="marca" maxlength="40" value="<?= $dados['marca']; ?>" required>
    </div>

    <div class="campo">
        <label for="descricao">Descrição:</label>
        <textarea name="descricao" id="descricao" rows="4" maxlength="500" required><?= htmlspecialchars($dados['descricao']); ?></textarea>
    </div>

    <div class="campo">
        <label for="faixaetaria">Faixa Etária (anos):</label>
        <input type="number" name="faixaetaria" id="faixaetaria" min="0" max="120" value="<?= $dados['faixaetaria']; ?>" required>
    </div>

    <div class="campo">
        <label for="datacad">Data de Cadastro:</label>
        <input type="datetime-local" name="datacad" id="datacad" value="<?= $datacad; ?>" required>
    </div>

    <div class="campo">
        <label>Foto Atual:</label>
        <?php 
            $imagem = empty($dados["foto"]) ? "semimagem.png" : $dados["foto"];
            echo "<img src='imagens/$imagem' alt='Imagem Atual'>";
        ?>
    </div>

    <div class="campo">
        <label for="foto">Alterar Foto:</label>
        <input type="file" name="foto" id="foto" accept="image/*">
    </div>

    <div class="botoes">
        <input type="submit" value="Salvar Alterações">
        <input type="reset" value="Limpar">
    </div>
</form>

</body>
</html>
