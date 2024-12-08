<?php
session_start();
include 'db_movies.php'; // Connect to the database

// If there is a search query
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
    <title>Movie list</title>
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
        .search-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 10px;
        }
        .search-container input[type="text"] {
            width: 70%;
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
        .playback-control {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Movie list</h1>
        
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
                    <th>Director:</th>
                    <th>Genre:</th>
                    <th>Play/Download</th>
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
                                <video controls class="playback-control">
                                    <source src="<?= htmlspecialchars($movie['video_path']); ?>" type="video/mp4">
                                    Your browser does not support this video.
                                </video>
                                <a href="<?= htmlspecialchars($movie['video_path']); ?>" download>Download</a>
                                <!-- Контроль скорости воспроизведения -->
                                <label for="playback-speed-<?= $movie['id']; ?>">Speed:</label>
                                <select id="playback-speed-<?= $movie['id']; ?>" onchange="setPlaybackSpeed(this)">
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
                        <td colspan="4" style="text-align:center;">No movies found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
        function setPlaybackSpeed(select) {
            var video = select.closest('td').querySelector('video');
            video.playbackRate = parseFloat(select.value);
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
