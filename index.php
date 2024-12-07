<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Секция с видео на фоне -->
    <div class="video-banner">
    <video autoplay muted loop>
        <source src="5192068-uhd_2160_4096_25fps.mp4" type="video/mp4">
    Ваш браузер не поддерживает видео.
</video>
       
    </div>

    <!-- Кнопки входа и регистрации справа -->
    <div class="auth-buttons">
        <a href="login.php" class="auth-button">Кіру</a>
        <a href="register.php" class="auth-button">Тіркелу</a>
    </div>

    <!-- Центральный контент -->
    <div class="content">
        <h1>Қазақ тілін үйрену платформасына қош келдіңіз!</h1>
        <p>Тіл үйрену сапарыңызды бастау үшін қазір тіркеліңіз.</p>
        <button class="join-button" onclick="window.location.href='register.php'">Қосылу</button>
    </div>
    
</body>
</html>