<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "real_estate";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM houses");

$houses = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $houses[] = $row;
    }
}

$conn->close();

// Возвращаем результаты в формате JSON
header('Content-Type: application/json');
echo json_encode($houses);
?>
