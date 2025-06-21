<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alterar Produto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/editar.css">
</head>
<body>

<!-- Navbar estilo Apple -->
<div class="navbar">
    <a href="index.php" class="botao-voltar">Voltar</a>
    <h3>Alteração de Produto</h3>
</div>

<?php
try {
    include("conexao.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["id"];
        $codigo = $_POST["codigo"];
        $modelo = $_POST["modelo"];
        $marca = $_POST["marca"];
        $descricao = $_POST["descricao"];
        $faixaetaria = $_POST["faixaetaria"];
        $datacad = $_POST["datacad"];

        $sqlbusca = "SELECT foto FROM brinquedos WHERE id = $id";
        $result = mysqli_query($conexao, $sqlbusca);
        $dados = mysqli_fetch_assoc($result);
        $fotoAntiga = $dados['foto'];

        // Verificar se foi enviada uma nova foto
        if (!empty($_FILES['foto']['name'])) {
            $foto = $_FILES['foto']['name'];
            $caminho = "imagens/" . $foto;
            $imageFileType = strtolower(pathinfo($caminho, PATHINFO_EXTENSION));

            // Validação da nova foto
            if ($_FILES['foto']['size'] > 5000000) {
                echo "<p class='erro'>O arquivo é muito grande. Tamanho máximo permitido: 5MB.</p>";
                exit();
            }

            if (!in_array($imageFileType, ["jpg", "jpeg", "png", "webp"])) {
                echo "<p class='erro'>Apenas arquivos JPG, JPEG, PNG e WEBP são permitidos.</p>";
                exit();
            }

            move_uploaded_file($_FILES['foto']['tmp_name'], $caminho);

            // Apagar a foto antiga se houver
            if (!empty($fotoAntiga) && $fotoAntiga != "semimagem.png") {
                $arquivoAntigo = "imagens/" . $fotoAntiga;
                if (file_exists($arquivoAntigo)) {
                    unlink($arquivoAntigo);
                }
            }
        } else {
            $foto = $fotoAntiga;
        }

        $sql = "UPDATE brinquedos SET 
                    codigo = '$codigo',
                    modelo = '$modelo',
                    marca = '$marca',
                    descricao = '$descricao',
                    faixaetaria = '$faixaetaria',
                    datacad = '$datacad',
                    foto = '$foto'
                WHERE id = $id";

        if (mysqli_query($conexao, $sql)) {
            echo "<h4>✅ Registro alterado com sucesso!</h4>";
        } else {
            echo "<h4 class='erro'>❌ Erro ao alterar: " . mysqli_error($conexao) . "</h4>";
        }

        mysqli_close($conexao);
    } else {
        echo "<h4 class='erro'>Requisição inválida.</h4>";
    }
} catch (Exception $e) {
    echo "<h4 class='erro'>Ocorreu um erro:<br>" . $e->getMessage() . "</h4>";
}
?>

</body>
</html>
