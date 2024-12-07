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
<<<<<<< HEAD

=======
>>>>>>> 2b9872a573cc8a8f1643d5202ce8da4756f6e472
<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <link rel="stylesheet" href="test.css">
    <title>Тест</title>
</head>
<body>
    <div class="container">
        <form action="results.php" method="POST">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="question">
                    <p><?php echo $row['question_text']; ?></p>
                    <label>
                        <input type="radio" name="question_<?php echo $row['id']; ?>" value="A">
                        <?php echo $row['option_a']; ?>
                    </label><br>
                    <label>
                        <input type="radio" name="question_<?php echo $row['id']; ?>" value="B">
                        <?php echo $row['option_b']; ?>
                    </label><br>
                    <label>
                        <input type="radio" name="question_<?php echo $row['id']; ?>" value="C">
                        <?php echo $row['option_c']; ?>
                    </label><br>
                    <label>
                        <input type="radio" name="question_<?php echo $row['id']; ?>" value="D">
                        <?php echo $row['option_d']; ?>
                    </label><br>
                </div>
            <?php } ?>
            <button type="submit" class="submit-btn">Жіберу</button>
        </form>
=======
    <title>Тапсырмалар тізімі</title>
    <title>Сәйкестік</title>
    <link rel="stylesheet" href="question.css">
</head>
<body>
    <div class="container">
        <h1>Тапсырмалар тізімі</h1>
        
        <?php
        // Әр тапсырманы көрсету
        while ($task = $result->fetch_assoc()) {
            echo "<h2>" . htmlspecialchars($task['question_text']) . "</h2>";
            echo "<p>А) " . htmlspecialchars($task['option_a']) . "</p>";
            echo "<p>Б) " . htmlspecialchars($task['option_b']) . "</p>";
            echo "<p>В) " . htmlspecialchars($task['option_c']) . "</p>";
            echo "<p>Г) " . htmlspecialchars($task['option_d']) . "</p>";
            echo "<p>Дұрыс жауап: " . htmlspecialchars($task['correct_option']) . "</p>";

            // Аудио көрсетілуі
            $audio_data = $task['audio_clip'];
            $audio_url = 'data:audio/mp3;base64,' . base64_encode($audio_data);
            echo "<audio controls>
                    <source src='" . $audio_url . "' type='audio/mp3'>
                    Сіздің браузеріңіз аудио ойнатуды қолдамайды.
                  </audio><br><br>";
        }

        // Дерекқорды жабу
        $connection->close();
        ?>
>>>>>>> 2b9872a573cc8a8f1643d5202ce8da4756f6e472
    </div>
</body>
</html>
