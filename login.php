<?
include("index.html");
?>


<?php
require 'bd.php'; // Подключение к базе данных

session_start(); // Начинаем сессию

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = trim($_POST['login']);
    $password = $_POST['password'];

    // Проверка на наличие пустых значений
    if (empty($login) || empty($password)) {
        die("Логин и пароль не могут быть пустыми.");
    }

    // Проверка логина и пароля в базе данных
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE login = ?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Простое сравнение пароля без хеширования
        if ($password === $user['password']) {
            // Успешная авторизация
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_login'] = $user['login'];

            echo "Вы успешно авторизованы! Добро пожаловать, " . htmlspecialchars($user['login']) . "!";
            // Используем JavaScript для перенаправления через 5 секунд
            echo "<script>
                    setTimeout(function() {
                        window.location.href = 'index.html'; // Укажите здесь нужный путь
                    }, 5000);
                  </script>";
            exit; // Завершаем выполнение скрипта
        } else {
            die("Неверный логин или пароль.");
        }
    } else {
        die("Пользователь не найден.");
    }

    $stmt->close();
}

// Закрываем соединение
$mysqli->close();
?>
