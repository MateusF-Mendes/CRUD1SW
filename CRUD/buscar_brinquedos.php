<?php
include("conexao.php");

$modelo = isset($_POST["modelo"]) ? mysqli_real_escape_string($conexao, $_POST["modelo"]) : "";
$faixa = isset($_POST["faixaetaria"]) ? $_POST["faixaetaria"] : "";

$sql = "SELECT * FROM brinquedos WHERE modelo LIKE '$modelo%'";

if ($faixa !== "") {
	$faixa = (int)$faixa;

	if ($faixa === 0) {
		$sql .= " AND faixaetaria BETWEEN 0 AND 5";
	} elseif ($faixa === 6) {
		$sql .= " AND faixaetaria BETWEEN 6 AND 10";
	} elseif ($faixa === 11) {
		$sql .= " AND faixaetaria BETWEEN 11 AND 15";
	} elseif ($faixa === 16) {
		$sql .= " AND faixaetaria >= 16";
	}
}

$sql .= " ORDER BY modelo";
$result = mysqli_query($conexao, $sql);

if (mysqli_num_rows($result) > 0) {
	echo "<div class='table-container'><table>
			<tr>
				<th>ID</th>
				<th>Código</th>
				<th>Modelo</th>
				<th>Marca</th>
				<th>Faixa Etária</th>
				<th>Data Cadastro</th>
				<th>Imagem</th>
				<th>Opções</th>
			</tr>";

	while ($dados = mysqli_fetch_assoc($result)) {
		$id = base64_encode($dados["id"]);
		$imagem = empty($dados["foto"]) ? "semimagem.png" : $dados["foto"];

		echo "<tr>
				<td>{$dados['id']}</td>
				<td>{$dados['codigo']}</td>
				<td>{$dados['modelo']}</td>
				<td>{$dados['marca']}</td>
				<td>{$dados['faixaetaria']} anos</td>
				<td>" . date('d/m/Y H:i', strtotime($dados['datacad'])) . "</td>
				<td><img class='imagem' src='imagens/$imagem' alt='Imagem'></td>
				<td>
					<a href='verproduto.php?id=$id'>Visualizar</a> |
					<a href='edicao.php?id=$id'>Editar</a> |
					<a href='excluir.php?id=$id'>Excluir</a>
				</td>
			</tr>";
	}

	echo "</table></div>";
} else {
	echo "<p class='empty-result'>Nenhum brinquedo encontrado.</p>";
}

mysqli_close($conexao);
?>