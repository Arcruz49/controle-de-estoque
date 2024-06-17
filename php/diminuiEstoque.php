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
    
    $sqlVerificacao = "SELECT quantidade FROM tb_produtos WHERE cdProduto = '$cdproduto'";
    $resultVerificacao = mysqli_query($conexao, $sqlVerificacao);

    if ($resultVerificacao) {
        $row = mysqli_fetch_assoc($resultVerificacao);
        
        if ($row['quantidade'] > 0) {
            $sql = "UPDATE tb_produtos SET quantidade = quantidade - 1 WHERE cdProduto = '$cdproduto'";
            $result = mysqli_query($conexao, $sql);
            
            if ($result) {
                echo "success";
            } else {
                echo "Não foi possível atualizar o produto.";
            }
        } else {
            echo "Quantidade insuficiente para diminuir.";
        }
    } else {
        echo "Erro ao buscar o produto.";
    }
    exit;
}

mysqli_close($conexao);
?>
