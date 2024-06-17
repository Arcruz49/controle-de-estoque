<?php
session_start();

if (!isset($_SESSION['nome'])) {
    header("Location: ../views/index.html");
    exit;
}

include "../config/dbconfig.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["cdProduto"]) || empty($_POST["nmProduto"]) || empty($_POST["descProduto"]) || empty($_POST["preco"]) || !isset($_POST["quantidade"])) {
        echo "Todos os campos são obrigatórios.";
        mysqli_close($conexao);
        exit;
    }

    $cdproduto = mysqli_real_escape_string($conexao, $_POST['cdProduto']);
    $nmproduto = mysqli_real_escape_string($conexao, $_POST['nmProduto']);
    $descproduto = mysqli_real_escape_string($conexao, $_POST['descProduto']);
    
    if (strlen($descproduto) >= 200) {
        $descproduto = substr($descproduto, 0, 200);
    }

    $preco = mysqli_real_escape_string($conexao, $_POST['preco']);
    $quantidade = mysqli_real_escape_string($conexao, $_POST['quantidade']);

    $update = "UPDATE tb_produtos SET nmProduto = '$nmproduto', descProduto = '$descproduto', preco = '$preco', quantidade = '$quantidade' WHERE cdProduto = '$cdproduto'";
    $result = mysqli_query($conexao, $update);

    if (!$result) {
        echo "Não foi possível atualizar os dados do produto.";
        mysqli_close($conexao);
        exit;
    } 

    echo "success";
}

mysqli_close($conexao);
?>
