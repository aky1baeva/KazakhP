<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Боковой Меню с Иконками и Анимацией</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Базалық стильдер */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            transition: margin-left 0.3s ease;
            background-color: #f4f4f9;
        }

        /* Боковое меню */
        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #ffffff; /* Ашық фон */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 15px 32px;
            text-decoration: none;
            font-size: 20px;
            color: #333333; /* Қара мәтін */
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #ffffff; /* Ақ мәтін */
            background-color: #0056b3; /* Ашық көгілдір фон */
            box-shadow: 0 0 10px #0056b3, 0 0 40px #0056b3; /* Неон эффекті */
        }

        /* Иконка меню */
        .menu-icon {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 30px;
            color: #0056b3; /* Ашық көгілдір */
            cursor: pointer;
            z-index: 1;
            transition: transform 0.5s;
        }

        /* Меню ашылған кезде */
        .sidenav.open {
            width: 250px;
        }

        .menu-icon.open {
            transform: rotate(180deg); /* Иконканың айналуы */
        }

        /* Иконкалар үшін қосымша стильдер */
        .sidenav a i {
            margin-right: 15px;
        }

        /* Сілтемелердің анимациясы */
        .sidenav a {
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .sidenav.open a {
            opacity: 1;
        }

        /* Сілтемелер үшін топтық блок */
        .sidenav a {
            display: flex;
            align-items: center;
        }

        /* Дашбордтың негізгі контенті */
        .main-content {
            padding-left: 270px;
            transition: padding-left 0.3s ease;
        }

        /* Қосымша түймелерді стильдеу */
        .sidenav a.logout {
            position: absolute;
            bottom: 30px;
            left: 20px;
        }

        /* Адаптивті дизайн */
        @media screen and (max-width: 768px) {
            .sidenav {
                width: 0;
                height: 100%;
                position: fixed;
                z-index: 1;
                top: 0;
                left: -250px;
                background-color: #ffffff;
                padding-top: 60px;
            }

            .sidenav.open {
                left: 0;
            }

            .main-content {
                padding-left: 0;
            }

            .menu-icon {
                display: block;
                position: fixed;
                top: 20px;
                left: 20px;
                z-index: 2;
            }
        }
    </style>
</head>
<body>

    <!-- Иконка, оны басқанда меню ашылады -->
    <div class="menu-icon" onclick="toggleMenu()">&#9776;</div>

    <!-- Боковое меню -->
    <div id="mySidenav" class="sidenav">
        <a href="#" class="dashboard-link"><i class="fas fa-tachometer-alt"></i> Дашборд</a>
        <a href="#"><i class="fas fa-level-up-alt"></i> 1-Деңгей</a>
        <a href="#"><i class="fas fa-level-up-alt"></i> 2-Деңгей</a>
        <a href="#"><i class="fas fa-level-up-alt"></i> 3-Деңгей</a>
        <a href="#"><i class="fas fa-book"></i> Сөздіктер</a>
        <a href="#"><i class="fas fa-question-circle"></i> Деңгей анықтау тесті</a>
        <a href="#"><i class="fas fa-book-reader"></i> Кітаптар</a>
        <a href="#"><i class="fas fa-headphones-alt"></i> Аудио кітаптар</a>
        <a href="#"><i class="fas fa-film"></i> Қазақша кинолар</a>
        <a href="#"><i class="fas fa-cogs"></i> Настройка</a>
        <a href="#"><i class="logout"><i class="fas fa-sign-out-alt"></i> Шығу</a>
    </div>

    <!-- Негізгі контент (Дашбордты көрсету үшін) -->
    <div class="main-content">
        <h1 class="text-center mt-5">Қазақ тілін үйрететін платформаның дашборды</h1>
        <p class="text-center">Мұнда сіз барлық деңгейлермен, сөздіктермен және басқа да оқу материалдарымен таныса аласыз.</p>
    </div>

    <script>
        // Менюді басқару функциясы
        function toggleMenu() {
            var menu = document.getElementById("mySidenav");
            var icon = document.querySelector(".menu-icon");
            var content = document.querySelector(".main-content");

            // Егер меню ашық болса, оны жабамыз
            if (menu.classList.contains("open")) {
                menu.classList.remove("open");
                icon.classList.remove("open");
                content.style.paddingLeft = "0";
            } else {
                // Егер меню жабық болса, оны ашамыз
                menu.classList.add("open");
                icon.classList.add("open");
                content.style.paddingLeft = "270px";
            }
        }
    </script>

</body>
</html>
