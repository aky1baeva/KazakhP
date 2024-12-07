<?php
require 'db.php';

// Получаем параметр поиска из GET запроса
$search = $_GET['search'] ?? ''; // Если параметр не задан, то используем пустую строку

// Создаем SQL запрос
$sql = "SELECT * FROM dictionaries";
if (!empty($search)) {
    $sql .= " WHERE kazakh_word LIKE :search OR translation LIKE :search"; // Используем LIKE для поиска
}

$stmt = $pdo->prepare($sql);

// Если есть параметр поиска, выполняем запрос с параметром
if (!empty($search)) {
    $stmt->execute(['search' => "%$search%"]); // Ищем по части слова
} else {
    $stmt->execute(); // Если поиск пустой, просто выводим все данные
}

$words = $stmt->fetchAll(PDO::FETCH_ASSOC); // Получаем результаты в виде массива
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Қазақ тіліндегі сөздік</title>
    <!-- Подключаем Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Ваши собственные стили -->
    <link rel="stylesheet" href="styles_d.css">
</head>
<body>
    <div class="container py-5">
        <div class="text-center mb-4">
            <h1 class="fw-bold">Қазақ тіліндегі сөздік</h1>
            <p class="text-muted">Қазақша сөздерді, олардың аудармаларын және мысалдарын зерттеңіз</p>
        </div>

        <!-- Форма для поиска -->
        <form method="GET" action="">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Сөзді іздеу..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                <button class="btn btn-primary" type="submit">Іздеу</button>
            </div>
        </form>

        <!-- Выводим таблицу с результатами поиска -->
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Қазақша сөз</th>
                            <th>Аударма</th>
                            <th>Аудио</th>
                            <th>Мысалы</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($words)): ?>
                            <?php foreach ($words as $word): ?>
                                <tr>
                                    <td><?= htmlspecialchars($word['kazakh_word']) ?></td>
                                    <td><?= htmlspecialchars($word['translation']) ?></td>
                                    <td>
                                        <?php if (!empty($word['audio_path'])): ?>
                                            <audio controls>
                                                <source src="<?= htmlspecialchars($word['audio_path']) ?>" type="audio/mpeg">
                                            </audio>
                                        <?php else: ?>
                                            Аудио жоқ
                                        <?php endif; ?>
                                    </td>
                                    <td><?= nl2br(htmlspecialchars($word['example_sentence'])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">Сөздер табылмады.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Подключаем Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


