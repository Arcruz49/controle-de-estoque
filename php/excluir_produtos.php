<?php

session_start();

if (!isset($_SESSION['nome'])) {
    header("Location: ../views/index.html");
    exit;
}

include "../config/dbconfig.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["cdProduto"])) {
        echo "Código do produto não foi encontrado.";
        exit;
    }

    $cdproduto = mysqli_real_escape_string($conexao, $_POST['cdProduto']);

    $delete = "DELETE FROM tb_produtos WHERE cdProduto = '$cdproduto';";
    $result = mysqli_query($conexao, $delete);

    if ($result) {
        echo "success";
        exit;
    } else {
        echo "Não foi possível deletar o produto.";
        exit;
    }
}

mysqli_close($conexao);
?>
