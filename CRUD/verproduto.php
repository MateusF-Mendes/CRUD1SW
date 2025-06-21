<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Detalhes do Produto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/verproduto.css">
</head>
<body>

<!-- Navbar estilo Apple -->
<div class="navbar">
    <a href="index.php" class="botao-voltar">Voltar</a>
    <h3>Detalhes do Produto</h3>
</div>

<?php
date_default_timezone_set("America/Sao_Paulo");

function formataData($data) {
    return date('d/m/Y H:i', strtotime($data));
}

try {
    include("conexao.php");

    if (isset($_GET["id"]) && is_numeric(base64_decode($_GET["id"]))) {
        $id = base64_decode($_GET["id"]);
    } else {
        header("Location: index.php");
        exit();
    }

    $sql = "SELECT * FROM brinquedos WHERE id = $id";
    $query = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($query) == 0) {
        echo "<h4 class='erro'>Produto não encontrado!</h4>";
    } else {
        $dados = mysqli_fetch_assoc($query);

        $imagem = (!empty($dados["foto"])) ? $dados["foto"] : "semimagem.png";

        echo "<table>
                <tr>
                    <td>
                        <img class='imagem' src='imagens/$imagem' onclick=\"abrirModal(this.src)\">
                    </td>
                    <td>
                        <b>ID:</b> {$dados['id']}<br>
                        <b>Código:</b> {$dados['codigo']}<br>
                        <b>Modelo:</b> {$dados['modelo']}<br>
                        <b>Marca:</b> {$dados['marca']}<br>
                        <b>Descrição:</b> {$dados['descricao']}<br>
                        <b>Faixa Etária:</b> {$dados['faixaetaria']} anos<br>
                        <b>Data de Cadastro:</b> " . formataData($dados["datacad"]) . "<br>
                    </td>
                </tr>
            </table>";
    }

    mysqli_close($conexao);

} catch (Exception $e) {
    echo "<h4 class='erro'>Ocorreu um erro:<br>" . $e->getMessage() . "</h4>";
}
?>

<!-- Modal da Imagem -->
<div id="modal" onclick="fecharModal()">
    <span class="fechar">&#10005;</span>
    <img class="modal-content" id="imgModal">
</div>

<script>
function abrirModal(src) {
    const modal = document.getElementById("modal");
    const img = document.getElementById("imgModal");
    img.src = src;
    modal.style.display = "flex";
}

function fecharModal() {
    const modal = document.getElementById("modal");
    modal.style.display = "none";
}
</script>

</body>
</html>
