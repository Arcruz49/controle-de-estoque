<?php

session_start();

if (!isset($_SESSION['nome'])) {
    header("Location: ../views/index.html");
    exit;
}

header('Content-Type: application/json');

include "../config/dbconfig.php";

$searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($conexao, $_GET['search']) : '';

$query = "SELECT cdProduto, nmProduto, descProduto, preco, quantidade FROM tb_produtos WHERE nmProduto like '%$searchTerm%'";
$result = mysqli_query($conexao, $query);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

$response = array(
    "data" => $data
);

echo json_encode($response);

mysqli_close($conexao);
?>
