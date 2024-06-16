<?php

session_start();

include "../config/dbconfig.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["usernameEmail"]) || empty($_POST["passwordLogin"])) {
        exit;
    }

    $current_date = date("Y/m/d");
    $insert = "INSERT INTO cadUsuario (nmUsuario, senha, dtCriacao) VALUES (cruz, admin, $current_date);";


    $result = mysqli_query($conexao, $sql);
    while($fetch = mysqli_fetch_row($result)) {
        echo "<p>". $fetch[0] . " - " . $fetch[1] . " - " . "</p>";
        

    }
}

mysqli_close($conexao);
?>
