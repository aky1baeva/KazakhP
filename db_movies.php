<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'kazakh_language'; // Замените 'movies_database' на ваше имя базы данных
$db_port = 3307; // Порт подключения

$conn = new mysqli($host, $username, $password, $dbname, $db_port);

if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}
?>
