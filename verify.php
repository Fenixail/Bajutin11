<?php
require 'bd.php'; // Подключение к базе данных

if (isset($_GET['code'])) {
    $verification_code = $_GET['code'];

    // Проверяем код подтверждения
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE verification_code = ?");
    $stmt->bind_param("s", $verification_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Код подтверждения найден, активируем пользователя
        $user = $result->fetch_assoc();
        $stmt = $mysqli->prepare("UPDATE users SET is_verified = 1 WHERE id = ?");
        $stmt->bind_param("i", $user['id']);
        
        if ($stmt->execute()) {
            echo "Ваш аккаунт успешно подтвержден!";
        } else {
            echo "Ошибка при подтверждении аккаунта.";
        }
    } else {
        echo "Не удалось найти код подтверждения.";
    }

    $stmt->close();
} else {
    echo "Код подтверждения не предоставлен.";
}

$mysqli->close();
?>
