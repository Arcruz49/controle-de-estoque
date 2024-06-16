<?php

session_start();

include "../config/dbconfig.php";

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

    $update = "UPDATE tb_produtos SET nmProduto = '$nmproduto', descproduto = '$descproduto', preco = '$preco', quantidade = '$quantidade') WHERE cdProduto = '$cdproduto';";
    $result = mysqli_query($conexao, $update);
    if ($result == false) {
        echo "Não foi possível atualizar os dados do produto.";
        exit;
    }

    echo "success";
    exit;
}

?>

