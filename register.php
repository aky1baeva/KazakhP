<?php
// Подключение к базе данных
$conn = new mysqli("localhost", "root", "", "kazakh_language");

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    if (!empty($username) && !empty($password)) {
        $stmt = $conn->prepare("INSERT INTO users (username, password, created_at) VALUES (?, ?, NOW())");
        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            echo "Тіркелу сәтті аяқталды! <a href='login.php'>Кіру</a>";
        } else {
            echo "Қате: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Барлық өрістерді толтырыңыз.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тіркелу</title>
    <link rel="stylesheet" href="styless.css">
</head>
<body>
    <div class="background">
        <div class="form-container">
            <h1>Тіркелу</h1>
            <form method="POST" action="login.php">
                <label for="username">Атыңызды енгізіңіз</label>
                <input type="text" name="username" placeholder="Атыңызды енгізіңіз" required>
                
                <label for="email">Электрондық поштаңызды енгізіңіз</label>
                <input type="email" name="email" placeholder="Электрондық поштаңызды енгізіңіз" required>
                
                <label for="password">Құпия сөзіңізді енгізіңіз</label>
                <input type="password" name="password" placeholder="Құпия сөзіңізді енгізіңіз" required>
                
                <button type="submit">Тіркелу</button>
            </form>
            <p>Аккаунтыңыз бар ма? <a href="login.html">Кіру</a></p>
        </div>
    </div>
</body>
</html>
