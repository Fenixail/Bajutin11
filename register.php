<?php
require 'bd.php'; // Подключение к базе данных
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Функция для регистрации пользователя
function registerUser($mysqli) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Получаем входные данные
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $login = $_POST['login'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Проверка на отсутствие пустых значений
        if (empty($firstname) || empty($lastname) || empty($login) || empty($email) || empty($password)) {
            die("Все поля являются обязательными для заполнения.");
        }

        // Проверка, существует ли уже логин в базе данных
        $stmt = $mysqli->prepare("SELECT * FROM users WHERE login = ?");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            die("Пользователь с таким логином уже существует.");
        } else {
            // Проверка, существует ли уже email в базе данных
            $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                die("Пользователь с таким email уже существует.");
            } else {
                // Генерация токена
                $token = bin2hex(random_bytes(16)); // Уникальный токен для подтверждения

                // Вставка нового пользователя в базу данных без хеширования пароля
                $stmt = $mysqli->prepare("INSERT INTO users (firstname, lastname, login, email, password, token) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $firstname, $lastname, $login, $email, $password, $token); // Храним пароль в открытом виде
                $stmt->execute();

                // Отправка письма с подтверждением
                sendConfirmationEmail($email, $firstname, $token);

                echo "Регистрация прошла успешно. Пожалуйста, проверьте вашу почту, чтобы подтвердить ваш аккаунт.";
            }
        }

        $stmt->close();
    }
}

// Функция для отправки письма с подтверждением
function sendConfirmationEmail($email, $firstname, $token) {
    $mail = new PHPMailer(true);
    try {
        // Настройки
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mrasim570@gmail.com';
        $mail->Password = 'mkir dsax mzdz tlef'; // Убедитесь, что это безопасный способ передачи пароля
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Получатели
        $mail->setFrom('rasim200419@gmail.com', 'Liderhouse');
        $mail->addAddress($email, $firstname); 

        // Ссылка для подтверждения
        $confirmationLink = 'http://localhost/Курсовая/myveb/confirm.php?token=' . $token; // Замените на ваш URL

        // Содержание
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Подтверждение электронной почты';
        $mail->Body    = 'Здравствуйте, ' . $firstname . '!<br>' .
                         'Пожалуйста, нажмите на следующую ссылку, чтобы подтвердить вашу электронную почту:<br>' .

                         '<a href="' . $confirmationLink . '">Подтвердить почту</a>';
        $mail->AltBody = 'Здравствуйте, ' . $firstname . '! Перейдите по следующей ссылке для подтверждения вашей электронной почты: ' .
                         $confirmationLink;

        // Отправляем
        $mail->send();
    } catch (Exception $e) {
        echo "Письмо не может быть отправлено. Ошибка: {$mail->ErrorInfo}";
    }
}

// Вызов функции регистрации
registerUser($mysqli);

// Закрываем соединение
$mysqli->close();
?>
