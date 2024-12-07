<?php
// Дерекқорға қосылу
$connection = new mysqli("localhost", "root", "", "kazakh_language");

// Қосылу қателігін тексеру
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Дұрыс жауаптарды алу
$query = "SELECT * FROM fill_in_the_blanks";
$result = $connection->query($query);

// Егер сұрау орындалмаса, қате туралы хабарлама шығарыңыз
if (!$result) {
    die("Query failed: " . $connection->error);
}

// Мәтіндер мен дұрыс жауаптарды массивке сақтау
$questions = [];
while ($row = $result->fetch_assoc()) {
    $questions[] = [
        'sentence' => $row['sentence'],
        'correct_answer' => $row['correct_answer']
    ];
}

$score = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($questions as $index => $question) {
        if (isset($_POST["answer_$index"]) && $_POST["answer_$index"] === $question['correct_answer']) {
            $score++;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Дұрыс сөзді кірістіру</title>
    <link rel="stylesheet" href="question.css">
</head>
<body>
    <div class="container">
        <form action="" method="POST">
            <?php foreach ($questions as $index => $question): ?>
                <p><?php echo $question['sentence']; ?></p>
                <input type="text" name="answer_<?php echo $index; ?>"><br><br>
            <?php endforeach; ?>

            <button type="submit">Жіберу</button>
        </form>

        <?php if (isset($score)): ?>
            <p>Сіздің ұпайыңыз: <?php echo $score; ?> / <?php echo count($questions); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
