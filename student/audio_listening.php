<?php
// Дерекқорға қосылу
$connection = new mysqli("localhost", "root", "", "kazakh_language",3307);

// Қосылу қателігін тексеру
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Сұрақты алу (id 2-ші сұрақты алу)
$query = "SELECT * FROM questions WHERE id = 2";
$result = $connection->query($query);

// Егер сұрау орындалмаса, қате туралы хабарлама шығарыңыз
if (!$result) {
    die("Query failed: " . $connection->error);
}

// Сұрақты және дұрыс жауапты алу
$question = $result->fetch_assoc();
$correct_answer = $question['correct_option'];
$score = 0;

// Пайдаланушының жауабын тексеру
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['question_2']) && $_POST['question_2'] === $correct_answer) {
        $score++;
    }
}
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аудио тыңдау</title>
    <link rel="stylesheet" href="question.css">
</head>
<body>
    <div class="container">
        <form action="" method="POST">
            <p><?php echo $question['question_text']; ?></p>
            <audio controls>
                <source src="audio/<?php echo $question['audio_file']; ?>" type="audio/mp3">
                Сіздің браузеріңіз аудио ойнатуды қолдамайды.
            </audio><br><br>

            <label>
                <input type="radio" name="question_2" value="A"> <?php echo $question['option_a']; ?>
            </label><br>
            <label>
                <input type="radio" name="question_2" value="B"> <?php echo $question['option_b']; ?>
            </label><br>

            <button type="submit">Жіберу</button>
        </form>

        <?php if (isset($score)): ?>
            <p>Сіздің ұпайыңыз: <?php echo $score; ?> / 1</p>
        <?php endif; ?>
    </div>
</body>
</html>
