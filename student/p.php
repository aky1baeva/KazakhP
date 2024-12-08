<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Side menu cards</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Базовые стили */
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
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 15px 32px;
            text-decoration: none;
            font-size: 20px;
            color: #333333;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #ffffff;
            background-color: #0056b3;
            box-shadow: 0 0 10px #0056b3, 0 0 40px #0056b3;
        }

        /* Иконка меню */
        .menu-icon {
            position: fixed;
            top: 20px;
            left: 20px;
            font-size: 30px;
            color: #0056b3;
            cursor: pointer;
            z-index: 1;
            transition: transform 0.5s;
        }

        .menu-icon.open {
            transform: rotate(180deg);
        }

        .sidenav.open {
            width: 250px;
        }

        .main-content {
            margin-left: 0;
            transition: margin-left 0.3s ease;
        }

        .sidenav.open ~ .main-content {
            margin-left: 270px;
        }

        /* Карточки */
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
            margin-top: 70px;
            max-width: 1500px;
            padding: 40px;
        }

        .card {
            flex: 0 0 calc(33.33% - 10px);
            border: none;
            border-radius: 20px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-body {
            text-align: center;
            padding: 10px;
        }

        .card-title {
            font-size: 0.9rem;
            font-weight: bold;
            color: #fff;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            border-radius: 15px;
            padding: 6px 12px;
            border: none;
            cursor: pointer;
            font-size: 0.8rem;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .icon {
            font-size: 5rem;
            color: #fff;
        }

        /* Цвета карточек */
        .blue { background: linear-gradient(135deg, #114a8b, #2a6fb5); }
        .green { background: linear-gradient(135deg, #16ca09, #0f8b04); }
        .orange { background: linear-gradient(135deg, #ffa90a, #ff7c00); }
        .red { background: linear-gradient(135deg, #c32626, #ff4b4b); }
        .purple { background: linear-gradient(135deg, #623fa8, #9457d3); }
        .yellow { background: linear-gradient(135deg, #ffd900, #ffb800); }
        .blue1 { background: linear-gradient(135deg, #16d3e0, #0da5b6); }
        .pink { background: linear-gradient(135deg, #b2226a, #ff63a5); }
        .brown { background: linear-gradient(135deg, #8B4513, #D2B48C); }
    </style>
</head>
<body>

    <!-- Иконка для открытия бокового меню -->
    <div class="menu-icon" onclick="toggleMenu()">&#9776;</div>

    <!-- Боковое меню -->
    <div id="mySidenav" class="sidenav">
        <a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="#"><i class="fas fa-level-up-alt"></i> Level-1</a>
        <a href="#"><i class="fas fa-level-up-alt"></i> Level-2</a>
        <a href="#"><i class="fas fa-level-up-alt"></i> Level-3</a>
        <a onclick="window.location.href='dictionary.php'"><i class="fas fa-book"></i> Dictionary</a> 
        <a onclick="window.location.href='index_question.php'"><i class="fas fa-question-circle"></i> Tasks</a>
        <a onclick="window.location.href='book_list.php'"><i class="fas fa-book-reader"></i> Books</a>
        <a onclick="window.location.href='audio_books.php'"><i class="fas fa-headphones-alt"></i> Audio-books</a>
        <a onclick="window.location.href='movies.php'"><i class="fas fa-film"></i> Kazakh movies</a>
        <a onclick="window.location.href='setting.php'"><i class="fas fa-cogs"></i> Settings</a>
        <a href="#"><i class="fas fa-sign-out-alt"></i> Exit</a>
    </div>

    <!-- Основная часть с карточками -->
    <div class="main-content">
        <div class="container">
            <div class="card blue">
                <div class="card-body">
                    <i class="icon fas fa-level-up-alt"></i>
                    <h5 class="card-title">Level-1</h5>
                    <button class="btn" onclick="window.location.href='1level.php'">Open</button>
                </div>
            </div>
            <div class="card green">
                <div class="card-body">
                    <i class="icon fas fa-level-up-alt"></i>
                    <h5 class="card-title">Level-2</h5>
                    <button class="btn" onclick="window.location.href='level2.php'">Open</button>
                </div>
            </div>
            <div class="card red">
                <div class="card-body">
                    <i class="icon fas fa-level-up-alt"></i>
                    <h5 class="card-title">Level-3</h5>
                    <button class="btn" onclick="window.location.href='level3.php'">Open</button>
                </div>
            </div>
            <div class="card orange">
                <div class="card-body">
                    <i class="icon fas fa-book"></i>
                    <h5 class="card-title">Dictionary</h5>
                    <button class="btn" onclick="window.location.href='dictionary.php'">Open</button>
                </div>
            </div>
            <div class="card purple">
                <div class="card-body">
                    <i class="icon fas fa-tasks"></i>
                    <h5 class="card-title">Tasks</h5>
                    <button class="btn" onclick="window.location.href='index_question.php'">Open</button>
                </div>
            </div>
            <div class="card yellow">
                <div class="card-body">
                    <i class="icon fas fa-book"></i>
                    <h5 class="card-title">Books</h5>
                    <button class="btn" onclick="window.location.href='book_list.php'">Open</button> 
                </div>
            </div>

            <div class="card blue1">
                <div class="card-body">
                    <i class="icon fas fa-headphones"></i>
                    <h5 class="card-title">Audio-books</h5>
                    <button class="btn" onclick="window.location.href='audio_books.php'">Open </button>
                </div>
            </div>

            <div class="card pink">
                <div class="card-body">
                    <i class="icon fas fa-film"></i>
                    <h5 class="card-title">Kazakh movies</h5>
                    <button class="btn" onclick="window.location.href='movies.php'">Open</button>
                </div>
            </div>

            <div class="card brown">
                <div class="card-body">
                    <i class="icon fas fa-cogs"></i>
                    <h5 class="card-title">Menu settings</h5>
                    <button class="btn" onclick="window.location.href='setting.php'">Open</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleMenu() {
            const menu = document.getElementById("mySidenav");
            const icon = document.querySelector(".menu-icon");
            menu.classList.toggle("open");
            icon.classList.toggle("open");
        }
    </script>
</body>
</html>
