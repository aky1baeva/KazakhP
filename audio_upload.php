<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kazakh_word = $_POST['kazakh_word'];
    $translation = $_POST['translation'];
    $example_sentence = $_POST['example_sentence'];

    // Аудио файлды жүктеу
    if (isset($_FILES['audio']) && $_FILES['audio']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        $audio_path = $upload_dir . basename($_FILES['audio']['name']);
        move_uploaded_file($_FILES['audio']['tmp_name'], $audio_path);
    } else {
        $audio_path = null;
    }

    // Жаңа сөзді дерекқорға қосу
    $stmt = $pdo->prepare("INSERT INTO dictionaries (kazakh_word, translation, audio_path, example_sentence) VALUES (?, ?, ?, ?)");
    $stmt->execute([$kazakh_word, $translation, $audio_path, $example_sentence]);

    header('Location: dictionary.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сөзді қосу</title>
</head>
<body>
    <h1>Жаңа сөз қосу</h1>
    <form method="POST" enctype="multipart/form-data">
        <label>Қазақша сөз:</label><br>
        <input type="text" name="kazakh_word" required><br><br>

        <label>Аударма:</label><br>
        <input type="text" name="translation" required><br><br>

        <label>Аудио файл:</label><br>
        <input type="file" name="audio"><br><br>

        <label>Мысал сөйлем:</label><br>
        <textarea name="example_sentence" rows="4"></textarea><br><br>

        <button type="submit">Қосу</button>
    </form>
</body>
</html>
