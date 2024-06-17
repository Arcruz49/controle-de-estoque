<?php
session_start();

if (!isset($_SESSION['nome'])) {
    header("Location: ../views/index.html");
    exit;
}

include "../config/dbconfig.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["cdUsuario"]) && empty($_POST["nmUsuario"]) && empty($_POST["email"]) && empty($_POST["senha"])) {
        echo "Todos os campos são obrigatórios.";
        mysqli_close($conexao);
        exit;
    }

    $cdusuario = mysqli_real_escape_string($conexao, $_POST['cdUsuario']);
    $nmusuario = mysqli_real_escape_string($conexao, $_POST['nmUsuario']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    $update = "UPDATE cadUsuario SET nmUsuario = '$nmusuario', email = '$email', senha = '$senha' WHERE cdUsuario = '$cdusuario'";
    $result = mysqli_query($conexao, $update);

    if (!$result) {
        echo "Não foi possível atualizar os dados do usuario.";
        mysqli_close($conexao);
        exit;
    } 

    echo "success";
}

mysqli_close($conexao);
?>
