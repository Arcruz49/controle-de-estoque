<?php

session_start();

if (!isset($_SESSION['nome'])) {
    header("Location: ../views/index.html");
    exit;
}

include "../config/dbconfig.php";
    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nmUsuario"]) && empty($_POST["email"]) && empty($_POST["senha"])) {
        echo "Campos obrigatórias.";
        mysqli_close($conexao);
        exit;
    }

    $nmusuario = mysqli_real_escape_string($conexao, $_POST["nmUsuario"]);
    $email = mysqli_real_escape_string($conexao, $_POST["email"]);
    $senha = mysqli_real_escape_string($conexao, $_POST["senha"]);

    $insert = "INSERT INTO cadUsuario (nmUsuario, email, senha, dtCriacao)
               VALUES ('$nmusuario', '$email', '$senha', NOW())";    
    
    $result = mysqli_query($conexao, $insert);

    if ($result == false) {
        echo "Não foi possível inserir os dados do usuario no banco.";
        mysqli_close($conexao);
        exit;
    }

    echo "success";
}

mysqli_close($conexao);
?>
