<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alteração de Brinquedo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/edicao.css">
    <style>
        .preview-imagem {
            max-width: 150px;
            margin-top: 10px;
            display: none;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
    </style>
</head>
<body>

<div class="navbar">
    <a href="index.php" class="botao-voltar">Voltar</a>
    <h3>Alteração de Brinquedo</h3>
</div>

<?php
try {
    include("conexao.php");

    if (!isset($_GET["id"])) throw new Exception("ID não informado.");
    $id = base64_decode($_GET["id"]);
    if (!is_numeric($id)) throw new Exception("ID inválido.");

    $sql = "SELECT * FROM brinquedos WHERE id = $id";
    $result = mysqli_query($conexao, $sql);
    if (!$result) throw new Exception("Erro na consulta: " . mysqli_error($conexao));
    if (mysqli_num_rows($result) == 0) {
        echo "<h4>Produto não encontrado.</h4><br><button onclick=\"window.location='index.php';\">Voltar</button>";
        exit();
    }

    $dados = mysqli_fetch_assoc($result);
    mysqli_close($conexao);

    $datacad = date('Y-m-d\TH:i', strtotime($dados['datacad']));
    $valorFormatado = number_format($dados['valor'], 2, ',', '');
} catch (Exception $e) {
    echo "<h4 class='erro'>Ocorreu um erro: <br>" . $e->getMessage() . "</h4><br><button onclick=\"window.location='index.php';\">Voltar</button>";
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
        <label for="valor">Valor (R$):</label>
        <input type="text" name="valor" id="valor" value="R$ <?= $valorFormatado; ?>" required>
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
        <label>Foto Atual:</label><br>
        <?php 
            $imagem = empty($dados["foto"]) ? "semimagem.png" : $dados["foto"];
            echo "<img src='imagens/$imagem' alt='Imagem Atual' style='max-width:150px;border:1px solid #ccc;border-radius:6px;'>";
        ?>
    </div>

    <div class="campo">
        <label for="foto">Alterar Foto:</label>
        <input type="file" name="foto" id="foto" accept="image/*">
        <img id="preview" class="preview-imagem" alt="Pré-visualização nova">
    </div>

    <div class="campo">
        <label><input type="checkbox" name="remover_imagem" value="1"> Remover imagem atual</label>
    </div>

    <div class="botoes">
        <input type="submit" value="Salvar Alterações">
        <input type="reset" value="Limpar" onclick="document.getElementById('preview').style.display='none'">
    </div>
</form>

<!-- Biblioteca IMask -->
<script src="https://unpkg.com/imask"></script>

<script>
  // Máscara para campo de valor
  const valorInput = document.getElementById("valor");

  const maskOptions = {
    mask: "R$ num",
    blocks: {
      num: {
        mask: Number,
        thousandsSeparator: ".",
        radix: ",",
        scale: 2,
        signed: false,
        padFractionalZeros: true,
        normalizeZeros: true
      }
    }
  };

  IMask(valorInput, maskOptions);

  // Pré-visualização da imagem
  document.getElementById("foto").addEventListener("change", function(event) {
    const preview = document.getElementById("preview");
    const file = event.target.files[0];

    if (file) {
      preview.src = URL.createObjectURL(file);
      preview.style.display = "block";
    } else {
      preview.style.display = "none";
    }
  });
</script>

</body>
</html>