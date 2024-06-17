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
        mysqli_close($conexao);
        exit;
    }

    $cdproduto = mysqli_real_escape_string($conexao, $_POST['cdProduto']);
    
    $sqlVerificacao = "SELECT quantidade FROM tb_produtos WHERE cdProduto = '$cdproduto'";
    $resultVerificacao = mysqli_query($conexao, $sqlVerificacao);

    if (!$resultVerificacao) {
        echo "Erro ao buscar o produto.";
        mysqli_close($conexao);
        exit;
    }

    $row = mysqli_fetch_assoc($resultVerificacao);
    
    if ($row['quantidade'] > 0) {
        $sql = "UPDATE tb_produtos SET quantidade = quantidade - 1 WHERE cdProduto = '$cdproduto'";
        $result = mysqli_query($conexao, $sql);
        
        if (!$result) {
            echo "Não foi possível atualizar o produto.";
            mysqli_close($conexao);
            exit;
        } 

        echo "success";
    } else {
        echo "Quantidade insuficiente para diminuir.";
    }
}

mysqli_close($conexao);
?>
