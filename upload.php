<?php
$servername = "localhost"; // Замените на адрес вашего сервера, если необходимо
$username = "root"; // Ваш логин MySQL
$password = ""; // Ваш пароль MySQL (оставьте пустым для XAMPP)
$dbname = "real_estate"; // Имя вашей базы данных

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Проверка, если форма отправлена
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $house_name = $_POST['house_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Загрузка изображения
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/"; // Убедитесь, что эта папка существует
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);

        // Убедитесь, что директория существует
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0755, true); // Создание директории, если она не существует
        }

        // Перемещение загруженного файла в целевую директорию
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            // Подготовка и выполнение SQL запроса
            $stmt = $conn->prepare("INSERT INTO houses (house_name, price, description, photo, phone, email) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sdssss", $house_name, $price, $description, $target_file, $phone, $email);
            
            if ($stmt->execute()) {
                echo "Объявление успешно добавлено!";
                echo '<script>
                setTimeout(function() {
                    window.location = "index.html"; 
                }, 5000);
              </script>';
            } else {
                echo "Ошибка: " . $stmt->error;
            }
            
            $stmt->close();
        } else {
            echo "Ошибка загрузки файла.";
        }
    } else {
        if ($_FILES['photo']['error'] != UPLOAD_ERR_NO_FILE) {
            echo "Ошибка с файлом: " . $_FILES['photo']['error'];
        } else {
            echo "Файл не был загружен.";
        }
    }
}

// Закрытие соединения
$conn->close();
?>
