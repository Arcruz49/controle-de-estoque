<?php

session_start();

include "../config/dbconfig.php"; // Verifique se esse arquivo contém a configuração correta da conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"]) || empty($_POST["password"])) {
        echo "Campos de nome e senha são obrigatórios";
        exit;
    }

    $nome = mysqli_real_escape_string($conexao, $_POST['name']);
    $senha = mysqli_real_escape_string($conexao, $_POST['password']);

    $select = "SELECT * FROM cadusuario WHERE nmUsuario = '$nome' AND senha = '$senha' LIMIT 1";
    $result = mysqli_query($conexao, $select);

    if (!$result) {
        echo "Erro na consulta: " . mysqli_error($conexao);
        exit;
    }

    if (mysqli_num_rows($result) == 0) {
        echo "Usuário inválido";
        exit;
    }

    $user = mysqli_fetch_assoc($result);

    $_SESSION['codigo'] = $user['cdUsuario'];
    $_SESSION['nome'] = $user['nmUsuario'];

    echo "success";
    exit;
}

mysqli_close($conexao);
?>
