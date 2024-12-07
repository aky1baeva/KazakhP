<?php
// Подключение к базе данных
$conn = new mysqli("localhost", "root", "", "kazakh_language",3307);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (!empty($username) && !empty($password)) {
        $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

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
    <title>Кіру</title>
    <link rel="stylesheet" href="styless.css">
</head>
<body>
    <div class="background">
        <div class="form-container">
            <h1>Кіру</h1>
            <form method="POST" action="p.php">
                <label for="email">Электрондық поштаңызды енгізіңіз</label>
                <input type="email" name="email" placeholder="Электрондық поштаңызды енгізіңіз" required>
                
                <label for="password">Құпия сөзіңізді енгізіңіз</label>
                <input type="password" name="password" placeholder="Құпия сөзіңізді енгізіңіз" required>
                
                <div class="options">
                    <label><input type="checkbox" name="remember"> Есте сақтау</label>
                    <a href="#">Құпия сөзді ұмыттыңыз ба?</a>
                </div>
                
                <button type="submit">Кіру</button>
            </form>
            <p>Аккаунтыңыз жоқ па? <a href="register.php">Тіркелу</a></p>
        </div>
    </div>
</body>
</html>

