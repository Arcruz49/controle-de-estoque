<?php
session_start();

if (!isset($_SESSION['nome'])) {
    header("Location: ../views/index.html");
    exit;
}

header('Content-Type: application/json');

include "../config/dbconfig.php";

$cdusuario = isset($_GET['cdUsuario']) ? mysqli_real_escape_string($conexao, $_GET['cdUsuario']) : '';

$response = [];

if ($cdusuario) {
    $query = "SELECT * FROM cadUsuario WHERE cdUsuario = '$cdusuario'";
    $result = mysqli_query($conexao, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $usuario = mysqli_fetch_assoc($result);
        $response = $usuario;
    } else {
        $response = ["error" => "Usuario não encontrado"];
    }
} else {
    $response = ["error" => "Parâmetro 'cdUsuario' não fornecido"];
}

echo json_encode($response);

mysqli_close($conexao);
?>
