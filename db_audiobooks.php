<?php
$host = 'localhost';
$dbname = 'kazakh_language';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Деректер базасына қосылу сәтсіз: " . $conn->connect_error);
}
?>