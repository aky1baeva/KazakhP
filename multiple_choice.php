<?php
// Дерекқорға қосылу
$connection = new mysqli("localhost", "root", "", "kazakh_language", 3307);

// Қосылу қателігін тексеру
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Сұрауды орындау
$query = "SELECT * FROM questions";
$result = $connection->query($query);

// Егер сұрау орындалмаса, қате туралы хабарлама шығарыңыз
if (!$result) {
    die("Query failed: " . $connection->error);
}
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тест</title>
    <link rel="stylesheet" href="test.css"> <!-- Стильдер қосу -->
</head>
<body>
    <div class="container">
        <h1>Қазақ тілі тесті</h1>
        <form action="results.php" method="POST">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="question">
                    <p><strong><?php echo htmlspecialchars($row['question_text']); ?></strong></p>

                    <!-- Жауаптар үшін радио батырмалары -->
                    <label>
                        <input type="radio" name="question_<?php echo $row['id']; ?>" value="A">
                        <?php echo htmlspecialchars($row['option_a']); ?>
                    </label><br>

                    <label>
                        <input type="radio" name="question_<?php echo $row['id']; ?>" value="B">
                        <?php echo htmlspecialchars($row['option_b']); ?>
                    </label><br>

                    <label>
                        <input type="radio" name="question_<?php echo $row['id']; ?>" value="C">
                        <?php echo htmlspecialchars($row['option_c']); ?>
                    </label><br>

                    <label>
                        <input type="radio" name="question_<?php echo $row['id']; ?>" value="D">
                        <?php echo htmlspecialchars($row['option_d']); ?>
                    </label><br>

                    <!-- Аудио (егер бар болса) -->
                    <?php
                    if (!empty($row['audio_clip'])) {
                        $audio_data = $row['audio_clip'];
                        $audio_url = 'data:audio/mp3;base64,' . base64_encode($audio_data);
                        echo "<audio controls>
                                <source src='" . $audio_url . "' type='audio/mp3'>
                                Сіздің браузеріңіз аудио ойнатуды қолдамайды.
                              </audio><br><br>";
                    }
                    ?>
                </div>
            <?php } ?>
            <button type="submit" class="submit-btn">Жіберу</button>
        </form>
    </div>
</body>
</html>

<?php
// Дерекқорды жабу
$connection->close();
?>
