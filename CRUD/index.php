<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Brinquedos - Listagem</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link rel="stylesheet" href="css/index.css">
</head>
<body>

	<h3>Listagem de Brinquedos</h3>

	<div class="nav-buttons">
		<a href="inclusao.php">Incluir</a>
		<a href="index.php">Atualizar</a>
	</div>

	<div class="search-bar">
		<input type="text" id="modelo" placeholder="Pesquisar por modelo">
		<select id="faixaetaria">
			<option value="">Filtrar por faixa etária</option>
			<option value="0">0-5 anos</option>
			<option value="6">6-10 anos</option>
			<option value="11">11-15 anos</option>
			<option value="16">16+ anos</option>
		</select>
	</div>

	<div id="resultado-tabela"></div>

	<script>
	function buscarBrinquedos() {
		const modelo = document.getElementById("modelo").value;
		const faixa = document.getElementById("faixaetaria").value;

		const xhr = new XMLHttpRequest();
		xhr.open("POST", "buscar_brinquedos.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.onreadystatechange = function () {
			if (xhr.readyState === 4 && xhr.status === 200) {
				document.getElementById("resultado-tabela").innerHTML = xhr.responseText;
			}
		};
		xhr.send("modelo=" + encodeURIComponent(modelo) + "&faixaetaria=" + encodeURIComponent(faixa));
	}

	document.getElementById("modelo").addEventListener("input", buscarBrinquedos);
	document.getElementById("faixaetaria").addEventListener("change", buscarBrinquedos);
	window.onload = buscarBrinquedos;
	</script>

</body>
</html>