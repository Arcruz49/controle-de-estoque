<?php

function verifcar_session() {
    session_start();

    if (!isset($_SESSION['nome'])) {
        header("Location: ../views/index.html");
        exit;
    }
}

?>

