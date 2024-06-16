<?php
    define('HOST','localhost');
    define('USUARIO','root');
    define('SENHA','');
    define('BD','bd_produtos');

    $conexao = mysqli_connect(HOST,USUARIO,SENHA,BD) or die ('DataBase connection error.');
?>
