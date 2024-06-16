<?php

session_start();

include "../config/dbconfig.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // TODO: Mudar para o que vai ser usado no html
    if (empty($_POST["cdProduto"])) {
        echo "Código do produto não foi achado.";
        exit;
    }

    $cdproduto = mysqli_real_escape_string($conexao, $_POST['cdproduto']);

    $delete = "DELETE FROM tb_produtos WHERE cdProduto = '$cdproduto';";
    $result = mysqli_query($conexao, $delete);
    if ($result == false) {
        echo "Não foi possível deletar o produto.";
        exit;
    }

    echo "success";
    exit;
}

?>

