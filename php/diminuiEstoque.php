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
    
    $sql = "UPDATE tb_produtos SET quantidade = quantidade - 1 WHERE cdProduto = '$cdproduto';";
    
    $result = mysqli_query($conexao, $sql);
    
    if ($result) {
        echo "success";
        exit;
    } else {
        echo "Não foi possível atualizar o produto.";
        exit;
    }
}

mysqli_close();
?>
