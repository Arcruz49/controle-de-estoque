<?php

session_start();

include "../config/dbconfig.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"]) || empty($_POST["password"])) {
        exit;
    }

    $nome = mysqli_real_escape_string($conexao, $_POST['name']);
    $senha = mysqli_real_escape_string($conexao, $_POST['password']);

    $select = "SELECT * FROM cadusuario WHERE nmUsuario = 'adm' AND senha = '123' LIMIT 1;";
    $result = mysqli_query($conexao, $sql);
    if (mysqli_num_rows($result) == 0) {
        echo "usuário inválido";
        exit;
    }

    $user = mysqli_fetch_assoc($result);

    $_SESSION['codigo'] = $user['cdUsuario'];
    $_SESSION['nome']   = $user['nmUsuario'];

    echo "success";
    exit;
}

mysqli_close($conexao);
?>
