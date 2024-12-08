<?php
session_start();
$host = 'localhost';
$dbname = 'kazakh_language';
$username = 'root';
$password = '';
$port = 3307;

$conn = new mysqli($host, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Деректер базасына қосылу сәтсіз: " . $conn->connect_error);
}

// Удаление записи
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $query = "DELETE FROM dictionaries WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        echo "<script>alert('Слово успешно удалено!');</script>";
    } else {
        echo "Ошибка при удалении: " . $conn->error;
    }
    $stmt->close();
}

// Обновление записи
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = (int)$_POST['id'];
    $kazakh_word = $_POST['kazakh_word'];
    $translation = $_POST['translation'];
    $example_sentence = $_POST['example_sentence'];

    $query = "UPDATE dictionaries SET kazakh_word = ?, translation = ?, example_sentence = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssi', $kazakh_word, $translation, $example_sentence, $id);
    if ($stmt->execute()) {
        echo "<script>alert('Слово успешно обновлено!');</script>";
    } else {
        echo "Ошибка при обновлении: " . $conn->error;
    }
    $stmt->close();
}

// Добавление новой записи
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['update'])) {
    $kazakh_word = $_POST['kazakh_word'];
    $translation = $_POST['translation'];
    $example_sentence = $_POST['example_sentence'];

    $audio_path = null;
    if (isset($_FILES['audio_file']) && $_FILES['audio_file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'audio/';
        $audio_path = $uploadDir . basename($_FILES['audio_file']['name']);
        move_uploaded_file($_FILES['audio_file']['tmp_name'], $audio_path);
    }

    $query = "INSERT INTO dictionaries (kazakh_word, translation, example_sentence, audio_path) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssss', $kazakh_word, $translation, $example_sentence, $audio_path);
    if ($stmt->execute()) {
        echo "<script>alert('Слово успешно добавлено!');</script>";
    } else {
        echo "Ошибка при добавлении: " . $conn->error;
    }
    $stmt->close();
}

// Получение всех записей
$query = "SELECT * FROM dictionaries";
$result = $conn->query($query);
$words = [];
if ($result) {
    $words = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление словарем</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h1 class="text-center mb-4">Управление словарем</h1>

    <!-- Форма для добавления -->
    <form action="" method="POST" enctype="multipart/form-data" class="mb-4">
        <div class="mb-3">
            <label for="kazakh_word" class="form-label">Казахское слово</label>
            <input type="text" name="kazakh_word" id="kazakh_word" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="translation" class="form-label">Перевод</label>
            <input type="text" name="translation" id="translation" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="example_sentence" class="form-label">Пример предложения</label>
            <textarea name="example_sentence" id="example_sentence" class="form-control" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="audio_file" class="form-label">Аудиофайл</label>
            <input type="file" name="audio_file" id="audio_file" class="form-control" accept="audio/*">
        </div>
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>

    <!-- Таблица записей -->
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Казахское слово</th>
            <th>Перевод</th>
            <th>Пример</th>
            <th>Аудио</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($words as $word): ?>
            <tr>
                <td><?= $word['id'] ?></td>
                <td><?= htmlspecialchars($word['kazakh_word']) ?></td>
                <td><?= htmlspecialchars($word['translation']) ?></td>
                <td><?= htmlspecialchars($word['example_sentence']) ?></td>
                <td>
                    <?php if (!empty($word['audio_path'])): ?>
                        <audio controls>
                            <source src="<?= htmlspecialchars($word['audio_path']) ?>" type="audio/mpeg">
                        </audio>
                    <?php else: ?>
                        Нет аудио
                    <?php endif; ?>
                </td>
                <td>
                    <form action="" method="POST" class="d-inline">
                        <input type="hidden" name="id" value="<?= $word['id'] ?>">
                        <input type="text" name="kazakh_word" value="<?= htmlspecialchars($word['kazakh_word']) ?>" required>
                        <input type="text" name="translation" value="<?= htmlspecialchars($word['translation']) ?>" required>
                        <textarea name="example_sentence" rows="1" required><?= htmlspecialchars($word['example_sentence']) ?></textarea>
                        <button type="submit" name="update" class="btn btn-warning btn-sm">Обновить</button>
                    </form>
                    <a href="?delete=<?= $word['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Удалить запись?')">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
