<?php
// Дерекқорға қосылу
$connection = new mysqli("localhost", "root", "", "kazakh_language", 3307);

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
    <title>Сәйкестік тапсырмасы</title>
    <link rel="stylesheet" href="test.css">
</head>
<body>
    <div class="container">
        <h1>Сәйкестік тапсырмасы</h1>
        
        <!-- Форманы жіберу -->
        <form action="" method="POST">
            <p>Келесі сөздерді аударыңыз:</p>
            <?php foreach ($words as $word => $translation): ?>
                <label>
                    <?php echo $word; ?> - 
                    <input type="text" name="<?php echo $word; ?>" placeholder="Аудармасын енгізіңіз">
                </label><br><br>
            <?php endforeach; ?>

            <button type="submit">Жіберу</button>
        </form>

        <!-- Нәтижелер -->
        <?php if (isset($score)): ?>
            <p>Сіздің ұпайыңыз: <?php echo $score; ?> / <?php echo count($words); ?></p>
            
            <!-- Деңгей көрсету -->
            <?php
            $total_words = count($words);
            if ($score >= $total_words * 0.8) {
                $level = "Жоғары"; // Жоғары деңгей
            } elseif ($score >= $total_words * 0.5) {
                $level = "Орташа"; // Орташа деңгей
            } else {
                $level = "Бастапқы"; // Бастапқы деңгей
            }
            ?>

            <p>Сіздің деңгейіңіз: <strong><?php echo $level; ?></strong></p>
            
            <!-- Нәтижеден кейін екі батырма -->
            <div class="button-container">
                <a href="" class="start-btn">Қайтадан өту</a>
                <a href="index_question.php" class="start-btn">Артқа қайту</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
// Дерекқорды жабу
$connection->close();
?>
