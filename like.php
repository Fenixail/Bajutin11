<?php
/* Включаем отчёт об ошибках для модуля mysqli */
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

/* Подключение к базе данных */
$mysqli = mysqli_connect('localhost', 'root', '', 'real_estate');

/* Установите желаемую кодировку после установления соединения */
mysqli_set_charset($mysqli, 'utf8mb4');

/* Проверяем соединение */
if (mysqli_connect_errno()) {
    die("Ошибка подключения: " . mysqli_connect_error());
}
?>
