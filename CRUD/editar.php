<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alterar Produto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/editar.css">
</head>
<body>

<div class="navbar">
    <a href="index.php" class="botao-voltar">Voltar</a>
    <h3>Alteração de Produto</h3>
</div>

<?php
try {
    include("conexao.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = (int) $_POST["id"];
        $codigo = mysqli_real_escape_string($conexao, $_POST["codigo"]);
        $modelo = mysqli_real_escape_string($conexao, $_POST["modelo"]);
        $marca = mysqli_real_escape_string($conexao, $_POST["marca"]);
        $descricao = mysqli_real_escape_string($conexao, $_POST["descricao"]);

        // Limpa valor: remove R$, pontos e substitui vírgula por ponto
        $valorLimpo = str_replace(['R$', '.', ','], ['', '', '.'], $_POST["valor"]);
        $valor = floatval(trim($valorLimpo));

        $faixaetaria = mysqli_real_escape_string($conexao, $_POST["faixaetaria"]);
        $datacad = mysqli_real_escape_string($conexao, $_POST["datacad"]);
        $removerImagem = isset($_POST["remover_imagem"]) && $_POST["remover_imagem"] == "1";

        // Verifica imagem existente
        $sqlbusca = "SELECT foto FROM brinquedos WHERE id = $id";
        $result = mysqli_query($conexao, $sqlbusca);
        $dados = mysqli_fetch_assoc($result);
        $fotoAntiga = $dados['foto'];
        $novaFoto = $fotoAntiga;

        if (!empty($_FILES['foto']['name'])) {
            $nomeFoto = preg_replace("/[^a-zA-Z0-9.]/", "_", $_FILES['foto']['name']);
            $nomeFoto = uniqid() . "_" . $nomeFoto;
            $caminho = "imagens/" . $nomeFoto;
            $extensao = strtolower(pathinfo($caminho, PATHINFO_EXTENSION));

            if ($_FILES['foto']['size'] > 5 * 1024 * 1024) {
                die("<p class='erro'>Imagem muito grande. Máximo permitido: 5MB.</p>");
            }

            if (!in_array($extensao, ['jpg', 'jpeg', 'png', 'webp'])) {
                die("<p class='erro'>Formato inválido. Use JPG, JPEG, PNG ou WEBP.</p>");
            }

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminho)) {
                $novaFoto = $nomeFoto;
                if (!empty($fotoAntiga) && $fotoAntiga !== "semimagem.png") {
                    $arquivoAntigo = "imagens/" . $fotoAntiga;
                    if (file_exists($arquivoAntigo)) {
                        unlink($arquivoAntigo);
                    }
                }
            } else {
                die("<p class='erro'>Erro ao fazer upload da nova imagem.</p>");
            }
        } elseif ($removerImagem) {
            if (!empty($fotoAntiga) && $fotoAntiga !== "semimagem.png") {
                $arquivoAntigo = "imagens/" . $fotoAntiga;
                if (file_exists($arquivoAntigo)) {
                    unlink($arquivoAntigo);
                }
            }
            $novaFoto = "semimagem.png";
        }

        $sql = "UPDATE brinquedos SET  
                    codigo = '$codigo',
                    modelo = '$modelo',
                    marca = '$marca',
                    descricao = '$descricao',
                    valor = $valor,
                    faixaetaria = '$faixaetaria',
                    datacad = '$datacad',
                    foto = '$novaFoto'
                WHERE id = $id";

        if (mysqli_query($conexao, $sql)) {
            echo "<h4 class='sucesso'>Registro alterado com sucesso!</h4>";
        } else {
            echo "<h4 class='erro'>Erro ao atualizar: " . mysqli_error($conexao) . "</h4>";
        }

        mysqli_close($conexao);
    } else {
        echo "<h4 class='erro'>Requisição inválida.</h4>";
    }
} catch (Exception $e) {
    echo "<h4 class='erro'>Erro inesperado:<br>" . $e->getMessage() . "</h4>";
}
?>

</body>
</html>