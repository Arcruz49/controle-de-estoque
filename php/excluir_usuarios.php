<?php

session_start();

if (!isset($_SESSION['nome'])) {
    header("Location: ../views/index.html");
    exit;
}

include "../config/dbconfig.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["cdUsuario"])) {
        echo "Código do produto não foi encontrado.";
        mysqli_close($conexao);
        exit;
    }

    $cdusuario = mysqli_real_escape_string($conexao, $_POST['cdUsuario']);

    $delete = "DELETE FROM cadUsuario WHERE cdUsuario = '$cdusuario';";
    $result = mysqli_query($conexao, $delete);

    if (!$result) {
        echo "Não foi possível deletar o usuario.";
        mysqli_close($conexao);
        exit;
    }

    echo "success";
}

mysqli_close($conexao);
?>
