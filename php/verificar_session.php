<?php
session_start();

if (!isset($_SESSION['nome'])) {
    echo 'noSession';
    exit;
}

echo 'sessionActive'; 
?>
