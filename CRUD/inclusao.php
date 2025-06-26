<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Brinquedos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/inclusao.css">
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
  <h3>Cadastro de Brinquedos</h3>
</div>

<div class="container">
  <form action="incluir.php" method="post" enctype="multipart/form-data">
    <div class="campo">
      <label for="codigo">Código:</label>
      <input type="number" name="codigo" id="codigo" required>
    </div>

    <div class="campo">
      <label for="modelo">Modelo:</label>
      <input type="text" name="modelo" id="modelo" maxlength="50" required>
    </div>

    <div class="campo">
      <label for="marca">Marca:</label>
      <input type="text" name="marca" id="marca" maxlength="40" required>
    </div>

    <div class="campo">
      <label for="descricao">Descrição:</label>
      <textarea name="descricao" id="descricao" rows="4" maxlength="500" required></textarea>
    </div>

    <div class="campo">
      <label for="valor">Valor (R$):</label>
      <input type="text" name="valor" id="valor" required>
    </div>

    <div class="campo">
      <label for="faixaetaria">Faixa Etária (anos):</label>
      <input type="number" name="faixaetaria" id="faixaetaria" min="0" max="120" required>
    </div>

    <div class="campo">
      <label for="datacad">Data de Cadastro:</label>
      <input type="datetime-local" name="datacad" id="datacad" required>
    </div>

    <div class="campo">
      <label for="foto">Foto:</label>
      <input type="file" name="foto" id="foto" accept="image/*">
      <img id="preview" class="preview-imagem" alt="Pré-visualização">
    </div>

    <div class="botoes">
      <input type="submit" value="Cadastrar">
      <input type="reset" value="Limpar" onclick="document.getElementById('preview').style.display='none'">
    </div>
  </form>
</div>

<!-- Biblioteca de máscara IMask -->
<script src="https://unpkg.com/imask"></script>

<script>
  // Máscara para campo de valor em R$
  const valorInput = document.getElementById("valor");
  const maskOptions = {
    mask: "R$ num",
    blocks: {
      num: {
        mask: Number,
        radix: ",",
        thousandsSeparator: ".",
        scale: 2,
        padFractionalZeros: true,
        normalizeZeros: true,
        signed: false
      }
    }
  };
  IMask(valorInput, maskOptions);

  // Pré-visualização de imagem
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