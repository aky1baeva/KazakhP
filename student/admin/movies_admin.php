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

// Удаление фильма
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $query = "DELETE FROM movies WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<script>alert('Фильм сәтті жойылды!');</script>";
    } else {
        echo "Қате: " . $conn->error;
    }
    $stmt->close();
}

// Обновление фильма
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = (int)$_POST['id'];
    $title = $_POST['title'];
    $director = $_POST['director'];
    $genre = $_POST['genre'];

    $query = "UPDATE movies SET title = ?, director = ?, genre = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssi", $title, $director, $genre, $id);
    if ($stmt->execute()) {
        echo "<script>alert('Фильм сәтті жаңартылды!');</script>";
    } else {
        echo "Қате: " . $conn->error;
    }
    $stmt->close();
}

// Добавление нового фильма
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['update'])) {
    $title = $_POST['title'];
    $director = $_POST['director'];
    $genre = $_POST['genre'];

    if (isset($_FILES['video_file']) && $_FILES['video_file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'videos/';
        $videoPath = $uploadDir . basename($_FILES['video_file']['name']);

        if (move_uploaded_file($_FILES['video_file']['tmp_name'], $videoPath)) {
            $query = "INSERT INTO movies (title, director, genre, video_path) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssss", $title, $director, $genre, $videoPath);
            if ($stmt->execute()) {
                echo "<script>alert('Фильм сәтті қосылды!');</script>";
            } else {
                echo "Қате: " . $conn->error;
            }
            $stmt->close();
        } else {
            echo "Файлды жүктеу сәтсіз болды.";
        }
    } else {
        echo "Видеофайлды таңдаңыз.";
    }
}

// Получение всех фильмов
$query = "SELECT * FROM movies";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Фильмдерді басқару</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin: 5px 0 10px;
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
        .actions {
            display: flex;
            gap: 10px;
        }
        .actions button {
            width: auto;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Фильмдерді басқару</h1>

    <!-- Форма для добавления фильмов -->
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="title">Атауы:</label>
        <input type="text" id="title" name="title" required>

        <label for="director">Режиссер:</label>
        <input type="text" id="director" name="director" required>

        <label for="genre">Жанр:</label>
        <input type="text" id="genre" name="genre" required>

        <label for="video_file">Видеофайл:</label>
        <input type="file" id="video_file" name="video_file" accept="video/*" required>

        <button type="submit">Қосу</button>
    </form>

    <!-- Таблица со списком фильмов -->
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Атауы</th>
            <th>Режиссер</th>
            <th>Жанр</th>
            <th>Файл</th>
            <th>Әрекеттер</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['title'] ?></td>
                <td><?= $row['director'] ?></td>
                <td><?= $row['genre'] ?></td>
                <td><a href="<?= $row['video_path'] ?>" target="_blank">Көру</a></td>
                <td class="actions">
                    <form action="" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <input type="text" name="title" value="<?= $row['title'] ?>" required>
                        <input type="text" name="director" value="<?= $row['director'] ?>" required>
                        <input type="text" name="genre" value="<?= $row['genre'] ?>" required>
                        <button type="submit" name="update">Жаңарту</button>
                    </form>
                    <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Жоюды растайсыз ба?')">Жою</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
