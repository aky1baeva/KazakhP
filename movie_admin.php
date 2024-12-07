<?php
// Подключение к базе данных
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'kazakh_language';
$db_port = 3307;

$conn = new mysqli($host, $username, $password, $dbname, $db_port);

if ($conn->connect_error) {
    die("Деректер базасына қосылу сәтсіз: " . $conn->connect_error);
}

// Обработка данных из формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $director = $_POST['director'] ?? ''; // New field for movies
    $author = $_POST['author'] ?? ''; // For audiobooks
    $genre = $_POST['genre'] ?? '';
    $is_movie = isset($_POST['is_movie']) ? 1 : 0; // Flag to distinguish between audiobook and movie

    // Проверяем, загружен ли файл
    if (isset($_FILES['audio_file']) && $_FILES['audio_file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'audio/';
        $filePath = $uploadDir . basename($_FILES['audio_file']['name']);
        
        // Перемещение загруженного файла в указанную директорию
        if (move_uploaded_file($_FILES['audio_file']['tmp_name'], $filePath)) {
            // Добавление данных в соответствующую таблицу
            if ($is_movie) {
                $query = "INSERT INTO movies (title, director, genre, video_path) VALUES (?, ?, ?, ?)";
            } else {
                $query = "INSERT INTO audiobooks (title, author, genre, audio_path) VALUES (?, ?, ?, ?)";
            }
            $stmt = $conn->prepare($query);
            if ($is_movie) {
                $stmt->bind_param("ssss", $title, $director, $genre, $filePath);
            } else {
                $stmt->bind_param("ssss", $title, $author, $genre, $filePath);
            }

            if ($stmt->execute()) {
                echo "Кіно/Аудиокітап сәтті қосылды!";
            } else {
                echo "Қате: " . $conn->error;
            }

            $stmt->close();
        } else {
            echo "Файлды жүктеу сәтсіз болды.";
        }
    } else {
        echo "Файлды таңдаңыз.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Кино/Аудиокітап қосу</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Кино/Аудиокітап қосу</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="title">Атауы:</label>
            <input type="text" id="title" name="title" required>

            <label for="author">Автор (Аудиокітап үшін):</label>
            <input type="text" id="author" name="author">

            <label for="director">Режиссер (Кино үшін):</label>
            <input type="text" id="director" name="director">

            <label for="genre">Жанр:</label>
            <select id="genre" name="genre" required>
                <option value="Роман">Роман</option>
                <option value="Повесть">Повесть</option>
                <option value="Поэзия">Поэзия</option>
                <option value="Фантастика">Фантастика</option>
                <option value="Басқа">Басқа</option>
            </select>

            <label for="audio_file">Файл (Аудиокітап үшін):</label>
            <input type="file" id="audio_file" name="audio_file" accept="audio/*" required>

            <label for="is_movie">
                <input type="checkbox" id="is_movie" name="is_movie" value="1"> Қосу ретінде кино/фильм
            </label>

            <button type="submit">Қосу</button>
        </form>
    </div>
</body>
</html>
