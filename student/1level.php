<?php
// Сабақтар тізімі
$lessons = [
    ['id' => 1, 'title' => 'Lesson 1: Сәлемдесу', 'icon' => '🖐️'],
    ['id' => 2, 'title' => 'Lesson 2: Қарапайым сұрақтар', 'icon' => '❓'],
    ['id' => 3, 'title' => 'Lesson 3: Күнделікті сөздер', 'icon' => '💬'],
];
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Қазақ тілін үйрену - Деңгейлер</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f9;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        header {
            background-color: #2c3e50;
            color: white;
            padding: 20px 0;
            text-align: center;
            font-size: 28px;
            font-weight: bold;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
            text-align: center;
            margin: 0;
            background-color: #34495e;
        }
        nav ul li {
            display: inline;
            margin: 0 15px;
        }
        nav ul li a {
            color: white;
            font-size: 18px;
            text-decoration: none;
            padding: 10px 15px;
            display: inline-block;
        }
        nav ul li a:hover {
            background-color: #27ae60;
            border-radius: 5px;
            transition: 0.3s;
        }
        .content {
            padding: 30px 20px;
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 30px;
        }
        .lesson-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px 0;
        }
        .lesson-item {
            background-color: #ecf0f1;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }
        .lesson-item:hover {
            transform: translateY(-10px);
            background-color: #f1f8f6;
        }
        .lesson-item .icon {
            font-size: 36px;
            margin-bottom: 10px;
        }
        .lesson-item .title {
            font-size: 20px;
            color: #2c3e50;
            font-weight: bold;
            margin-top: 10px;
            text-decoration: none;
        }
        .lesson-item a {
            text-decoration: none;
            color: inherit;
        }
        .lesson-item a:hover {
            color: #27ae60;
        }
        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 10px;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

    <header>
        Қазақ тілін үйрену - Бастауыш деңгей
    </header>

    <section class="content">
        <h2>Сабақтар тізімі</h2>
        <div class="lesson-list">
            <?php foreach ($lessons as $lesson): ?>
                <div class="lesson-item">
                    <div class="icon"><?php echo $lesson['icon']; ?></div>
                    <a href="lesson.php?id=<?php echo $lesson['id']; ?>" class="title"><?php echo $lesson['title']; ?></a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Қазақ тілін үйрену. Барлық құқықтар қорғалған.</p>
    </footer>

</body>
</html>
