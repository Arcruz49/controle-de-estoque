<?php

session_start();

if (!isset($_SESSION['nome'])) {
    header("Location: ../views/index.html");
    exit;
}

include "../config/dbconfig.php";
    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nmProduto"]) || empty($_POST["descProduto"]) || empty($_POST["preco"]) || empty($_POST["quantidade"])) {
        echo "Campos obrigatórias.";
        exit;
    }
    $nmproduto = mysqli_real_escape_string($conexao, $_POST['nmProduto']);
    $descproduto = mysqli_real_escape_string($conexao, $_POST['descProduto']);
    if (strlen($descproduto) >= 200) {
        $descproduto = substr($descproduto, 0, 200);
    }

    $preco = mysqli_real_escape_string($conexao, $_POST['preco']);
    $quantidade = mysqli_real_escape_string($conexao, $_POST['quantidade']);

    $insert = "INSERT INTO tb_produtos (nmProduto, descProduto, preco, quantidade, dtCriacao) 
               VALUES ('$nmproduto', '$descproduto', '$preco', '$quantidade', NOW())";    
    
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
