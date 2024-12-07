<?php
// Дерекқорға қосылу
$connection = new mysqli("localhost", "root", "", "kazakh_language");

// Қосылу қателігін тексеру
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Сәйкестік тапсырмаларын алу
$query = "SELECT * FROM matching_pairs";
$result = $connection->query($query);

// Егер сұрау орындалмаса, қате туралы хабарлама шығарыңыз
if (!$result) {
    die("Query failed: " . $connection->error);
}

// Сөздер мен аудармалар массивіне деректерді сақтау
$words = [];
while ($row = $result->fetch_assoc()) {
    $words[$row['word']] = $row['translation'];
}

// Ұпайды есептеу
$score = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($words as $word => $translation) {
        if (isset($_POST[$word]) && $_POST[$word] === $translation) {
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
    <title>Сәйкестік</title>
    <link rel="stylesheet" href="question.css">
</head>
<body>
    <div class="container">
        <form action="" method="POST">
            <p>Келесі сөздерді аударыңыз:</p>
            <?php foreach ($words as $word => $translation): ?>
                <label><?php echo $word; ?> - <input type="text" name="<?php echo $word; ?>" placeholder="Аудармасын енгізіңіз"></label><br><br>
            <?php endforeach; ?>

            <button type="submit">Жіберу</button>
        </form>

        <?php if (isset($score)): ?>
            <p>Сіздің ұпайыңыз: <?php echo $score; ?> / <?php echo count($words); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
