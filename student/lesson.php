<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lesson 1: Сәлемдесу - Қазақ тілін үйрену</title>
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
            font-size: 24px;
            font-weight: bold;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
            text-align: center;
            background-color: #34495e;
            margin: 0;
            display: flex;
            justify-content: center;
        }
        nav ul li {
            display: inline;
            margin: 0 20px;
        }
        nav ul li a {
            color: white;
            font-size: 18px;
            text-decoration: none;
            padding: 10px 15px;
            display: inline-block;
        }
        nav ul li a:hover, nav ul li a.active {
            background-color: #27ae60;
            border-radius: 5px;
            transition: 0.3s;
        }
        .content {
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .tab-content {
            display: none;
            padding: 20px;
        }
        .tab-content.active {
            display: block;
        }
        iframe {
            width: 100%;
            height: 400px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .task-form {
            margin-top: 30px;
        }
        input[type="text"] {
            padding: 12px;
            font-size: 16px;
            width: 80%;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            padding: 12px 30px;
            font-size: 16px;
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background-color: #2ecc71;
        }
        .message {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
            text-align: center;
        }
        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 40px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

    <header>
        Сабақ 1: Сәлемдесу
    </header>

    <nav>
        <ul>
            <li><a href="javascript:void(0);" onclick="openTab('lessonContent')" class="active">Сабақтың мазмұны</a></li>
            <li><a href="javascript:void(0);" onclick="openTab('videoLesson')">Видео сабақ</a></li>
            <li><a href="javascript:void(0);" onclick="openTab('taskSection')">Тапсырма</a></li>
        </ul>
    </nav>

    <section class="content">
        <!-- Сабақтың мазмұны бөлімі -->
        <div id="lessonContent" class="tab-content active">
            <h2>Сабақтың мазмұны</h2>
            <p>Бұл сабақта сіз қазақ тіліндегі сәлемдесу сөздерімен танысасыз. Мысалы: "Сәлем!", "Қалайсыңыз?"</p>
        </div>

        <!-- Видео сабақ бөлімі -->
        <div id="videoLesson" class="tab-content">
            <h2>Видео сабақ</h2>
            <iframe src="https://www.youtube.com/embed/Xm_cwC5r-YE" title="Сәлемдесу видео сабақ" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>

        <!-- Тапсырма бөлімі -->
        <div id="taskSection" class="tab-content">
            <h2>Тапсырма</h2>
            <p>Қазақ тілінде "Сәлем!" деген сөзді жазып, оны төмендегі өріске енгізіңіз:</p>
            <form action="" method="post" class="task-form">
                <input type="text" name="task_answer" required>
                <button type="submit">Жіберу</button>
            </form>

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $task_answer = $_POST['task_answer'];
                $correct_answer = "Сәлем!";
                if (strtolower($task_answer) == strtolower($correct_answer)) {
                    echo "<p class='message'>Жауабыңыз дұрыс!</p>";
                } else {
                    echo "<p class='message'>Жауабыңыз қате, қайтадан көріңіз!</p>";
                }
            }
            ?>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Қазақ тілін үйрену. Барлық құқықтар қорғалған.</p>
    </footer>

    <script>
        function openTab(tabName) {
            // Барлық бөлімдерден "active" класын алып тастау
            var tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(function(tab) {
                tab.classList.remove('active');
            });

            // Барлық сілтемелерден "active" класын алып тастау
            var links = document.querySelectorAll('nav ul li a');
            links.forEach(function(link) {
                link.classList.remove('active');
            });

            // Таңдалған бөлімге "active" класын қосу
            var activeTab = document.getElementById(tabName);
            activeTab.classList.add('active');

            // Таңдалған сілтемеге "active" класын қосу
            var activeLink = document.querySelector('a[href="javascript:void(0);"][onclick="openTab(\'' + tabName + '\')"]');
            activeLink.classList.add('active');
        }
    </script>

</body>
</html>
