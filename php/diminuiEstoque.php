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
    
    $sqlValidacao = "SELECT quantidade FROM tb_produtos WHERE cdProduto = '$cdproduto'";
    $resultValidacao = mysqli_query($conexao, $sqlValidacao);

    $row = mysqli_fetch_assoc($resultValidacao);

    if ($row['quantidade'] <= 0) {
        echo "O estoque já está vazio";
        exit;
    }

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
