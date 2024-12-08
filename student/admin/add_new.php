<?php
session_start();
include 'db_book.php'; // Database connection

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Handle book deletion
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];
    $deleteQuery = "DELETE FROM books WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $deleteId);
    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Error deleting book!";
    }
    exit;
}

// Handle book editing
if (isset($_GET['edit_id'])) {
    $editId = $_GET['edit_id'];
    $query = "SELECT * FROM books WHERE id = $editId";
    $result = $conn->query($query);
    $book = $result->fetch_assoc();

    if (!$book) {
        echo "Book not found!";
        exit;
    }
}

// Handle form submission for editing or adding new book
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $description = $_POST['description'];
    $file_path = $_POST['file_path'];
    $image_path = $_POST['image_path'];
    $user_id = $_SESSION['user_id'];

    // If there's an edit, update the book
    if (isset($_POST['edit_id'])) {
        $editId = $_POST['edit_id'];
        $updateQuery = "UPDATE books SET title = ?, author = ?, genre = ?, description = ?, file_path = ?, image_path = ? WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("ssssssi", $title, $author, $genre, $description, $file_path, $image_path, $editId);
        if ($stmt->execute()) {
            header("Location: index.php");
        } else {
            echo "Error updating book!";
        }
    } else {
        // If it's a new book, insert it
        $insertQuery = "INSERT INTO books (title, author, genre, description, file_path, image_path, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ssssssi", $title, $author, $genre, $description, $file_path, $image_path, $user_id);
        if ($stmt->execute()) {
            header("Location: index.php");
        } else {
            echo "Error adding book!";
        }
    }
    exit;
}

// Retrieve books to display
$query = "SELECT id, title, author, genre, file_path FROM books ORDER BY title";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a {
            text-decoration: none;
            color: #007BFF;
        }
        a:hover {
            text-decoration: underline;
        }
        .back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
            color: #007BFF;
            font-size: 16px;
        }
        .back-btn:hover {
            background-color: #e2e2e2;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Back Button -->
        <a href="p.php" class="back-btn">← Back</a>

        <h1>List of Books</h1>

        <a href="index.php?add_new=true" class="back-btn">+ Add New Book</a>

        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($book = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($book['title']); ?></td>
                            <td><?= htmlspecialchars($book['author']); ?></td>
                            <td><?= htmlspecialchars($book['genre']); ?></td>
                            <td>
                                <a href="index.php?edit_id=<?= $book['id']; ?>">Edit</a> |
                                <a href="index.php?delete_id=<?= $book['id']; ?>" onclick="return confirm('Are you sure you want to delete this book?')">Delete</a> |
                                <a href="<?= htmlspecialchars($book['file_path']); ?>" target="_blank">Read</a> |
                                <a href="<?= htmlspecialchars($book['file_path']); ?>" download>Download</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align:center;">No books found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php if (isset($_GET['add_new']) || isset($_GET['edit_id'])): ?>
            <h1><?= isset($_GET['edit_id']) ? 'Edit Book' : 'Add New Book'; ?></h1>
            <form method="POST">
                <?php if (isset($_GET['edit_id'])): ?>
                    <input type="hidden" name="edit_id" value="<?= $book['id']; ?>">
                <?php endif; ?>

                <label for="title">Title:</label>
                <input type="text" name="title" value="<?= isset($book['title']) ? htmlspecialchars($book['title']) : ''; ?>" required><br>

                <label for="author">Author:</label>
                <input type="text" name="author" value="<?= isset($book['author']) ? htmlspecialchars($book['author']) : ''; ?>" required><br>

                <label for="genre">Genre:</label>
                <input type="text" name="genre" value="<?= isset($book['genre']) ? htmlspecialchars($book['genre']) : ''; ?>" required><br>

                <label for="description">Description:</label>
                <textarea name="description"><?= isset($book['description']) ? htmlspecialchars($book['description']) : ''; ?></textarea><br>

                <label for="file_path">File Path:</label>
                <input type="text" name="file_path" value="<?= isset($book['file_path']) ? htmlspecialchars($book['file_path']) : ''; ?>"><br>

                <label for="image_path">Image Path:</label>
                <input type="text" name="image_path" value="<?= isset($book['image_path']) ? htmlspecialchars($book['image_path']) : ''; ?>"><br>

                <button type="submit"><?= isset($book) ? 'Update Book' : 'Add Book'; ?></button>
            </form>
        <?php endif; ?>

    </div>
</body>
</html>

<?php
$conn->close();
?>
