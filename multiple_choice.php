<?php
// Дерекқорға қосылу
$connection = new mysqli("localhost", "root", "", "kazakh_language", 3307);

// Қосылу қателігін тексеру
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Тапсырмаларды алу сұрауы
$query = "SELECT * FROM tasks";
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
    </div>
</body>
</html>
