<?php
$host = 'localhost';
$dbname = 'kazakh_language';
$username = 'root';
$password = '';
$db_port = 3307;

$conn = new mysqli($host, $username, $password, $dbname, $db_port);

if ($conn->connect_error) {
    die("Деректер базасына қосылу сәтсіз: " . $conn->connect_error);
}
?>