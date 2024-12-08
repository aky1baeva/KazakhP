<?php
// Подключение к базе данных
$connection = new mysqli("localhost", "root", "", "kazakh_language", 3307);

// Проверка подключения
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Добавление нового задания
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_task'])) {
    $new_word = $connection->real_escape_string($_POST['new_word']);
    $new_translation = $connection->real_escape_string($_POST['new_translation']);

    $add_query = "INSERT INTO matching_pairs (word, translation) VALUES ('$new_word', '$new_translation')";
    if (!$connection->query($add_query)) {
        die("Error adding task: " . $connection->error);
    }
}

// Обновление задания
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_task'])) {
    $task_id = intval($_POST['task_id']);
    $updated_word = $connection->real_escape_string($_POST['updated_word']);
    $updated_translation = $connection->real_escape_string($_POST['updated_translation']);

    $update_query = "UPDATE matching_pairs SET word='$updated_word', translation='$updated_translation' WHERE id=$task_id";
    if (!$connection->query($update_query)) {
        die("Error updating task: " . $connection->error);
    }
}

// Удаление задания
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_task'])) {
    $task_id = intval($_POST['task_id']);

    $delete_query = "DELETE FROM matching_pairs WHERE id=$task_id";
    if (!$connection->query($delete_query)) {
        die("Error deleting task: " . $connection->error);
    }
}

// Получение всех заданий
$query = "SELECT * FROM matching_pairs";
$result = $connection->query($query);
if (!$result) {
    die("Query failed: " . $connection->error);
}
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление заданиями</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Управление заданиями</h1>

    <!-- Форма добавления задания -->
    <h2>Добавить новое задание</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="new_word" class="form-label">Слово:</label>
            <input type="text" id="new_word" name="new_word" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="new_translation" class="form-label">Аударма:</label>
            <input type="text" id="new_translation" name="new_translation" class="form-control" required>
        </div>
        <button type="submit" name="add_task" class="btn btn-primary">Добавить</button>
    </form>

    <!-- Таблица заданий -->
    <h2 class="mt-5">Список заданий</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Слово</th>
            <th>Аударма</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['word']; ?></td>
                <td><?php echo $row['translation']; ?></td>
                <td>
                    <!-- Кнопка редактирования -->
                    <button class="btn btn-warning btn-sm" onclick="editTask(<?php echo $row['id']; ?>, '<?php echo $row['word']; ?>', '<?php echo $row['translation']; ?>')">Редактировать</button>

                    <!-- Форма удаления -->
                    <form method="POST" class="d-inline">
                        <input type="hidden" name="task_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="delete_task" class="btn btn-danger btn-sm">Удалить</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Форма редактирования -->
    <div id="editForm" style="display: none;">
        <h2>Редактировать задание</h2>
        <form method="POST">
            <input type="hidden" id="edit_task_id" name="task_id">
            <div class="mb-3">
                <label for="updated_word" class="form-label">Слово:</label>
                <input type="text" id="updated_word" name="updated_word" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="updated_translation" class="form-label">Аударма:</label>
                <input type="text" id="updated_translation" name="updated_translation" class="form-control" required>
            </div>
            <button type="submit" name="update_task" class="btn btn-success">Сохранить изменения</button>
        </form>
    </div>
</div>

<script>
    // Показать форму редактирования с заполнением данных
    function editTask(id, word, translation) {
        document.getElementById('editForm').style.display = 'block';
        document.getElementById('edit_task_id').value = id;
        document.getElementById('updated_word').value = word;
        document.getElementById('updated_translation').value = translation;
    }
</script>

</body>
</html>

<?php
// Закрытие соединения
$connection->close();
?>
