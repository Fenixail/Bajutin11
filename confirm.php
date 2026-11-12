<?php
require 'bd.php'; // Подключение к базе данных

// Получаем токен из URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Проверка токена в базе данных
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Если токен верный, обновить статус подтверждения пользователя
        $stmt = $mysqli->prepare("UPDATE users SET confirmed = 1, token = NULL WHERE token = ?");
        $stmt->bind_param("s", $token);
        $stmt->execute();

        // Обработка завершена успешно
        echo '<h1>Вы успешно подтвердили свою почту!</h1>';
        echo '<script>setTimeout(function() { window.location.href = "http://localhost:8000/index.html"; }, 5000);</script>';// Перенаправление через 5 секунд
    } else {
        // Токен неверный
        echo '<h1>Неверный токен.</h1>';
    }

    $stmt->close();
} else {
    // Токен не указан
    echo '<h1>Токен не указан.</h1>';
}

$mysqli->close();
?>