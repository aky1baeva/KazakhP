<?php
session_start();
include 'movie_admin.php'; // Деректер базасына қосылу

// Егер іздеу сұрауы болса
$search_query = '';
if (isset($_GET['query'])) {
    $search_query = $conn->real_escape_string($_GET['query']);
    $query = "SELECT id, title, director, genre, video_path FROM movies 
              WHERE title LIKE '%$search_query%' OR director LIKE '%$search_query%' OR genre LIKE '%$search_query%' 
              ORDER BY title";
} else {
    $query = "SELECT id, title, director, genre, video_path FROM movies ORDER BY title";
}

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Кино фильмдер тізімі</title>
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
        video {
            width: 100%;
            margin-top: 10px;
        }
        a {
            text-decoration: none;
            color: #007BFF;
        }
        a:hover {
            text-decoration: underline;
        }
        /* Іздеу контейнері стилі */
        .search-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 10px; /* Ені мен биіктікті аздап кеңейту үшін */
        }
        .search-container input[type="text"] {
            width: 70%; /* Аздап кеңейтіңіз */
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            outline: none;
        }
        .search-container button {
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .search-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Кино фильмдер тізімі</h1>
        
        <!-- Іздеу формасы -->
        <form action="" method="GET" class="search-container">
            <input type="text" name="query" placeholder="Іздеу..." value="<?= htmlspecialchars($search_query); ?>" required>
            <button type="submit">Іздеу</button>
        </form>
        
        <table>
            <thead>
                <tr>
                    <th>Атауы</th>
                    <th>Режиссер</th>
                    <th>Жанр</th>
                    <th>Таңдау/Жүктеу</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($movie = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($movie['title']); ?></td>
                            <td><?= htmlspecialchars($movie['director']); ?></td>
                            <td><?= htmlspecialchars($movie['genre']); ?></td>
                            <td>
                                <video controls>
                                    <source src="<?= htmlspecialchars($movie['video_path']); ?>" type="video/mp4">
                                    Сіздің браузеріңіз бұл бейнені қолдамайды.
                                </video>
                                <a href="<?= htmlspecialchars($movie['video_path']); ?>" download>Жүктеу</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align:center;">Фильмдер табылмады.</td>
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
