<?php
header('Content-Type: application/json');

include "../config/dbconfig.php";

$searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($conexao, $_GET['search']) : '';

$query = "SELECT cdUsuario, nmUsuario, email, dtCriacao FROM cadUsuario WHERE nmUsuario like '%$searchTerm%'";
$result = mysqli_query($conexao, $query);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

$response = array(
    "data" => $data
);

echo json_encode($response);

mysqli_close($conexao);
?>
