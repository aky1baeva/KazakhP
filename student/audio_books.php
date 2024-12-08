<?php
session_start();
include 'db_audiobooks.php'; // Деректер базасына қосылу

// Егер іздеу сұрауы болса
$search_query = '';
if (isset($_GET['query'])) {
    $search_query = $conn->real_escape_string($_GET['query']);
    $query = "SELECT id, title, author, genre, audio_path FROM audiobooks 
              WHERE title LIKE '%$search_query%' OR author LIKE '%$search_query%' OR genre LIKE '%$search_query%' 
              ORDER BY title";
} else {
    $query = "SELECT id, title, author, genre, audio_path FROM audiobooks ORDER BY title";
}

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audiobook list</title>
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
        audio {
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
        /* Контроль скорости воспроизведения аудио */
        .playback-control {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Audiobook list</h1>
        <!-- Іздеу формасы -->
        <form action="" method="GET" class="search-container">
            <input type="text" name="query" placeholder="Search..." value="<?= htmlspecialchars($search_query); ?>" required>
                    <button onclick="history.back()" style="margin: 10px; padding: 10px 15px; background-color: #007BFF; color: white; border: none; border-radius: 4px; cursor: pointer;">
        Back</button>
    <button type="submit">Search</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Title:</th>
                    <th>Author:</th>
                    <th>Genre:</th>
                    <th>Listen/Download:</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($audiobook = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($audiobook['title']); ?></td>
                            <td><?= htmlspecialchars($audiobook['author']); ?></td>
                            <td><?= htmlspecialchars($audiobook['genre']); ?></td>
                            <td>
                                <audio controls class="playback-control">
                                    <source src="<?= htmlspecialchars($audiobook['audio_path']); ?>" type="audio/mpeg">
                                    Your browser does not support this video.
                                </audio>
                                <a href="<?= htmlspecialchars($audiobook['audio_path']); ?>" download>Download</a>
                                <!-- Контроль скорости воспроизведения -->
                                <label for="playback-speed-<?= $audiobook['id']; ?>">Speed:</label>
                                <select id="playback-speed-<?= $audiobook['id']; ?>" onchange="setPlaybackSpeed(this)">
                                    <option value="0.5">0.5x</option>
                                    <option value="1" selected>1x</option>
                                    <option value="1.5">1.5x</option>
                                    <option value="2">2x</option>
                                </select>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align:center;">No audiobooks found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
        function setPlaybackSpeed(select) {
            var audio = select.closest('td').querySelector('audio');
            audio.playbackRate = parseFloat(select.value);
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
