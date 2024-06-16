<?php

session_start();

if (!isset($_SESSION['nome'])) {
    header("Location: ../views/index.html");
    exit;
}

include "../config/dbconfig.php";

/*
    cdProduto,
    nmProduto,
    descProduto,
    preco,
    quantidade,
    dtCriacao,
 */

    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // TODO: Mudar para o que vai ser usado no html
    if (empty($_POST["cdProduto"]) || empty($_POST["nmProduto"]) || empty($_POST["descProduto"]) || empty($_POST["preco"]) || empty($_POST["quantidade"])) {
        echo "Coisas obrigatórias.";
        exit;
    }

    $cdproduto = mysqli_real_escape_string($conexao, $_POST['cdproduto']);
    $nmproduto = mysqli_real_escape_string($conexao, $_POST['nmproduto']);
    $descproduto = mysqli_real_escape_string($conexao, $_POST['descproduto']);
    if (strlen($descproduto) >= 100) {
        $descproduto = substr($descproduto, 0, 100);
    }

    $preco = mysqli_real_escape_string($conexao, $_POST['preco']);
    $quantidade = mysqli_real_escape_string($conexao, $_POST['quantidade']);

    $insert = "INSERT INTO tb_produtos (nmProduto, descProduto, preco, quantidade, dtCriacao) VALUES ('$nmproduto', '$descproduto', '$preco', '$quantidade' NOW());";
    $result = mysqli_query($conexao, $insert);
    if ($result == false) {
        echo "Não foi possível inserir os dados no banco.";
        exit;
    }

    echo "success";
    exit;
}

mysqli_close($conexao);
?>
