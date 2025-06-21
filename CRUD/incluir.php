<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Cadastro de Brinquedos</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/incluir.css">
</head>
<body>

<div class="navbar">
    <a href="index.php" class="botao-voltar">Voltar</a>
    <h3>Cadastro de Brinquedos</h3>
</div>	

<?php
try {
	include("conexao.php");

	$codigo = $_POST["codigo"];
	$modelo = $_POST["modelo"];
	$marca = $_POST["marca"];
	$descricao = $_POST["descricao"];
	$faixaetaria = $_POST["faixaetaria"];
	date_default_timezone_set('America/Sao_Paulo');
	$datacad = date('Y-m-d H:i:s');

	$target_dir = "imagens/";
	$arquivo = basename($_FILES["foto"]["name"]);
	$arquivo = preg_replace("/[^a-zA-Z0-9.]/", "_", $arquivo);
	$arquivo = uniqid() . "_" . $arquivo;
	$target_file = $target_dir . $arquivo;
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

	// Verificação do tipo de imagem
	if (!empty($_FILES["foto"]["tmp_name"])) {
		$check = getimagesize($_FILES["foto"]["tmp_name"]);
		if ($check === false) {
			echo "<p class='erro'>O arquivo não é uma imagem.</p>";
			$uploadOk = 0;
		}

		// Verificar se o arquivo já existe
		if (file_exists($target_file)) {
			echo "<p class='erro'>O arquivo já existe.</p>";
			$uploadOk = 0;
		}

		// Verificar o tamanho do arquivo (5MB)
		if ($_FILES["foto"]["size"] > 5000000) {
			echo "<p class='erro'>O arquivo é muito grande. Tamanho máximo permitido: 5MB.</p>";
			$uploadOk = 0;
		}

		// Aceitar apenas .jpg, .png e .webp
		if (!in_array($imageFileType, ["jpg", "jpeg", "png", "webp"])) {
			echo "<p class='erro'>Apenas arquivos JPG, JPEG, PNG e WEBP são permitidos.</p>";
			$uploadOk = 0;
		}

		// Se a imagem for válida, move para o diretório
		if ($uploadOk) {
			if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
				echo "<p class='sucesso'>Imagem enviada com sucesso.</p>";
			} else {
				echo "<p class='erro'>Erro ao enviar a imagem.</p>";
				$arquivo = "";
			}
		} else {
			$arquivo = "";
		}
	} else {
		$arquivo = "";
	}

	// Inserção no banco de dados
	$sql = "INSERT INTO brinquedos (codigo, modelo, marca, descricao, faixaetaria, datacad, foto)
			VALUES ($codigo, '$modelo', '$marca', '$descricao', $faixaetaria, '$datacad', '$arquivo')";

	if (mysqli_query($conexao, $sql)) {
		echo "<h3 class='sucesso'>Registro cadastrado com sucesso!</h3>";
	} else {
		echo "<h3 class='erro'>Erro ao cadastrar: " . mysqli_error($conexao) . "</h3>";
	}

	mysqli_close($conexao);
} catch (Exception $e) {
	echo "<h3 class='erro'>Ocorreu um erro: " . $e->getMessage() . "</h3>";
}
?>

<button onclick="window.location='index.php';">Voltar</button>

</body>
</html>
