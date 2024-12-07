<?php
// Дерекқорға қосылу
$connection = new mysqli("localhost", "root", "", "kazakh_language");

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

// Әр тапсырманы көрсету
while ($task = $result->fetch_assoc()) {
    echo "<h2>" . $task['question_text'] . "</h2>";
    echo "<p>А) " . $task['option_a'] . "</p>";
    echo "<p>Б) " . $task['option_b'] . "</p>";
    echo "<p>В) " . $task['option_c'] . "</p>";
    echo "<p>Г) " . $task['option_d'] . "</p>";
    echo "<p>Дұрыс жауап: " . $task['correct_option'] . "</p>";
    
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
