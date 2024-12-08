<?php
session_start();
$host = 'localhost';
$dbname = 'kazakh_language';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Деректер базасына қосылу сәтсіз: " . $conn->connect_error);
}

// Handle book deletion
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $query = "DELETE FROM books WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<script>alert('Кітап сәтті жойылды!');</script>";
    } else {
        echo "Қате: " . $conn->error;
    }
    $stmt->close();
}

// Handle book update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = (int)$_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];

    $query = "UPDATE books SET title = ?, author = ?, genre = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssi", $title, $author, $genre, $id);
    if ($stmt->execute()) {
        echo "<script>alert('Кітап сәтті жаңартылды!');</script>";
    } else {
        echo "Қате: " . $conn->error;
    }
    $stmt->close();
}

// Handle new book insertion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['update'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];

    if (isset($_FILES['book_file']) && $_FILES['book_file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'upload/';
        $filePath = $uploadDir . basename($_FILES['book_file']['name']);

        // Проверка на успешную загрузку файла
        if (move_uploaded_file($_FILES['book_file']['tmp_name'], $filePath)) {
            $query = "INSERT INTO books (title, author, genre, file_path) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssss", $title, $author, $genre, $filePath);

            if ($stmt->execute()) {
                echo "<script>alert('Кітап сәтті қосылды!');</script>";
            } else {
                echo "Ошибка при добавлении книги: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Файл не был загружен. Ошибка: " . $_FILES['book_file']['error'];
        }
    } else {
        echo "Кітап файлын таңдаңыз.";
    }
}

// Retrieve all books
$query = "SELECT * FROM books";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Кітаптарды басқару</title>
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
    <h1>Кітаптарды басқару</h1>

    <!-- Form for adding a new book -->
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="title">Атауы:</label>
        <input type="text" id="title" name="title" required>

        <label for="author">Автор:</label>
        <input type="text" id="author" name="author" required>

        <label for="genre">Жанр:</label>
        <select id="genre" name="genre" required>
            <option value="Роман">Роман</option>
            <option value="Повесть">Повесть</option>
            <option value="Поэзия">Поэзия</option>
            <option value="Фантастика">Фантастика</option>
            <option value="Басқа">Басқа</option>
        </select>

        <label for="book_file">Кітап файлы:</label>
        <input type="file" id="book_file" name="book_file" accept=".pdf,.epub,.mobi" required>

        <button type="submit">Қосу</button>
    </form>

    <!-- Table to display the list of books -->
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Атауы</th>
            <th>Автор</th>
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
                <td><?= $row['author'] ?></td>
                <td><?= $row['genre'] ?></td>
                <td><a href="<?= $row['file_path'] ?>" target="_blank">Оқу</a></td>
                <td class="actions">
                    <!-- Edit form for each book -->
                    <form action="" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <input type="text" name="title" value="<?= $row['title'] ?>" required>
                        <input type="text" name="author" value="<?= $row['author'] ?>" required>
                        <select name="genre" required>
                            <option value="Роман" <?= $row['genre'] === 'Роман' ? 'selected' : '' ?>>Роман</option>
                            <option value="Повесть" <?= $row['genre'] === 'Повесть' ? 'selected' : '' ?>>Повесть</option>
                            <option value="Поэзия" <?= $row['genre'] === 'Поэзия' ? 'selected' : '' ?>>Поэзия</option>
                            <option value="Фантастика" <?= $row['genre'] === 'Фантастика' ? 'selected' : '' ?>>Фантастика</option>
                            <option value="Басқа" <?= $row['genre'] === 'Басқа' ? 'selected' : '' ?>>Басқа</option>
                        </select>
                        <button type="submit" name="update">Жаңарту</button>
                    </form>
                    <!-- Delete button -->
                    <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Жоюды растайсыз ба?')">Жою</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>

<?php
$conn->close();
?>
