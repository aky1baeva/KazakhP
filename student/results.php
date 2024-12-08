<?php
$connection = new mysqli("localhost", "root", "", "kazakh_language");

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$query = "SELECT * FROM questions";
$result = $connection->query($query);

$score = 0;  // Нөлден бастау
$total_questions = $result->num_rows;  // Жалпы сұрақтар санын алу

// POST деректерін тексеру және ұпайларды есептеу
while ($row = $result->fetch_assoc()) {
    $question_id = "question_" . $row['id'];
    if (isset($_POST[$question_id]) && $_POST[$question_id] === $row['correct_option']) {
        $score++;
    }
}

// Деңгейді анықтау
if ($score >= $total_questions * 0.8) {
    $level = "Advanced"; // Жоғары деңгей
} elseif ($score >= $total_questions * 0.5) {
    $level = "Intermediate"; // Орташа деңгей
} else {
    $level = "Beginner"; // Бастапқы деңгей
}
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="test.css">
    <title>Нәтижелер</title>
</head>
<body>
    <div class="container">
        <h1>Сіздің нәтижелеріңіз</h1>
        <p>Сіз <?php echo $total_questions; ?> сұрақтың ішінен <?php echo $score; ?> дұрыс жауап бердіңіз.</p>
        <p>Сіздің деңгейіңіз: <strong>
            <?php
            // Деңгей көрсетуді қазақша аудару
            echo $level === "Advanced" ? "Жоғары" : ($level === "Intermediate" ? "Орташа" : "Бастапқы");
            ?>
        </strong></p>
        <div class="button-container">
            <a href="test.php" class="start-btn">Қайтадан өту</a>
            <a href="index_question.php" class="start-btn">Артқа қайту</a>
        </div>
    </div>
</body>
</html>
