<?php
session_start();

if (!isset($_SESSION['nome'])) {
    header("Location: ../views/index.html");
    exit;
}

header('Content-Type: application/json');

include "../config/dbconfig.php";

$cdproduto = isset($_GET['cdProduto']) ? mysqli_real_escape_string($conexao, $_GET['cdProduto']) : '';

$response = [];

if ($cdproduto) {
    $query = "SELECT * FROM tb_produtos WHERE cdProduto = '$cdproduto'";
    $result = mysqli_query($conexao, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $produto = mysqli_fetch_assoc($result);
        $response = $produto;
    } else {
        $response = ["error" => "Produto não encontrado"];
    }
} else {
    $response = ["error" => "Parâmetro 'cdProduto' não fornecido"];
}

echo json_encode($response);

mysqli_close($conexao);
?>
