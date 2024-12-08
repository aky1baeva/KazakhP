<?php
session_start();
include 'db_book.php'; // Деректер базасына қосылу

// Кітаптарды алу
$query = "SELECT id, title, author, genre, file_path FROM books ORDER BY title";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book list</title>
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

        /* Артқа қайту батырмасы */
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
        <!-- Артқа қайту батырмасы -->
        <a href="p.php" class="back-btn">← Back</a>

        <h1>List of books</h1>
        <table>
            <thead>
                <tr>
                    <th>Title:</th>
                    <th>Author:</th>
                    <th>Genre:</th>
                    <th>Read/Download</th>
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
    </div>
</body>
</html>

<?php
$conn->close();
?>
