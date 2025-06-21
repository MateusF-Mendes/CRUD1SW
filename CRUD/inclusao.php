<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Brinquedos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/inclusao.css">
</head>
<body>

<!-- Navbar estilo Apple -->
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
    </div>

    <div class="botoes">
      <input type="submit" value="Cadastrar">
      <input type="reset" value="Limpar">
    </div>

  </form>
</div>

</body>
</html>
