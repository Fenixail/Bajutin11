<?php
$servername = "localhost"; // Замените на адрес вашего сервера, если необходимо
$username = "root"; // Замените на ваш логин MySQL
$password = ""; // Замените на ваш пароль MySQL
$dbname = "real_estate"; // Имя вашей базы данных

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Предполагается, что данные для нового дома получены через POST-запрос
$house_name = $_POST['house_name'];
$price = $_POST['price'];
$description = $_POST['description'];
$photo = $_POST['photo'];
$phone = $_POST['phone'];
$email = $_POST['email'];

// Вставляем данные нового дома в базу данных
$stmt = $conn->prepare("INSERT INTO houses (house_name, price, description, photo, phone, email) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sdssss", $house_name, $price, $description, $photo, $phone, $email);
$stmt->execute();

// Получаем ID последнего вставленного объявления
$last_id = $stmt->insert_id;

// Формируем HTML содержимое для нового объявления
$html_content = "<html>
<head>
    <title>$house_name</title>
</head>
<body>
    <h2>$house_name</h2>
    <p>Цена: $price $</p>
    <p>Описание: $description</p>
    <img src='$photo' alt='Фото дома' style='width:200px;'><br>
    <p>Телефон: $phone</p>
    <p>Email: $email</p>
</body>
</html>";

// Сохраняем HTML файл в папке House
file_put_contents("Houses/house$last_id.html", $html_content);

// Закрываем подготовленный запрос и соединение
$stmt->close();
$conn->close();

// Редирект на страницу отображения списка домов или уведомление об успешном создании
header("Location: index.html");
exit();
?>
