<?php
$host = 'localhost';
$dbname = 'kazakh_language';
$username = 'root';
$password = '';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=kazakh_language', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Дерекқорға қосылу қатесі: " . $e->getMessage());
}

?>
