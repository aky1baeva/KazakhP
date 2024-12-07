<?php
// Дерекқорға қосылу
$connection = new mysqli("localhost", "root", "", "kazakh_language");

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
    </div>
</body>
</html>
