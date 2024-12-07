<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Қазақ тілін үйрену</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card img {
            width: 100%;
            border-radius: 10px;
        }

        .card-body {
            text-align: center;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #fff;
        }

        .btn {
            background-color: #007bff;
            color: white;
            border-radius: 20px;
            padding: 10px 20px;
            border: none;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .col-md-4 {
            width: 250px;
            margin-bottom: 30px;
        }

        .blue { background-color: #007bff; }
        .green { background-color: #28a745; }
        .orange { background-color: #fd7e14; }
        .red { background-color: #dc3545; }
        .purple { background-color: #6f42c1; }
        .yellow { background-color: #ffc107; }
        .brown { background-color: #6c757d; }
        .pink { background-color: #e83e8c; }
    </style>
</head>
<body>

    <div class="container">
        <div class="text-center mb-5">
            <h1 class="fw-bold">Қазақ тілін үйрену платформасы</h1>
            <p class="text-muted">Қазақ тілін үйренудің қызықты жолдарын таңдаңыз</p>
        </div>

        <!-- 1-ші жол -->
        <div class="row">
            <div class="col-md-4">
                <div class="card blue">
                    <img src="images/level1.jpg" alt="Деңгей 1">
                    <div class="card-body">
                        <h5 class="card-title">1-Деңгей</h5>
                        <button class="btn">Ашу</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card green">
                    <img src="images/level2.jpg" alt="Деңгей 2">
                    <div class="card-body">
                        <h5 class="card-title">2-Деңгей</h5>
                        <button class="btn">Ашу</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card orange">
                    <img src="images/level3.jpg" alt="Деңгей 3">
                    <div class="card-body">
                        <h5 class="card-title">3-Деңгей</h5>
                        <button class="btn">Ашу</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2-ші жол -->
        <div class="row">
            <div class="col-md-4">
                <div class="card red">
                    <img src="images/dictionaries.jpg" alt="Сөздіктер">
                    <div class="card-body">
                        <h5 class="card-title">Сөздіктер</h5>
                        <button class="btn">Ашу</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card purple">
                    <img src="images/test.jpg" alt="Деңгей анықтау тесті">
                    <div class="card-body">
                        <h5 class="card-title">Деңгей анықтау тесті</h5>
                        <button class="btn">Ашу</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card yellow">
                    <img src="images/books.jpg" alt="Кітаптар">
                    <div class="card-body">
                        <h5 class="card-title">Кітаптар</h5>
                        <button class="btn">Ашу</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3-ші жол -->
        <div class="row">
            <div class="col-md-4">
                <div class="card brown">
                    <img src="images/audio_books.jpg" alt="Аудио кітаптар">
                    <div class="card-body">
                        <h5 class="card-title">Аудио кітаптар</h5>
                        <button class="btn">Ашу</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card pink">
                    <img src="images/movies.jpg" alt="Қазақша кинолар">
                    <div class="card-body">
                        <h5 class="card-title">Қазақша кинолар</h5>
                        <button class="btn">Ашу</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card blue">
                    <img src="images/settings.jpg" alt="Настройка">
                    <div class="card-body">
                        <h5 class="card-title">Настройка</h5>
                        <button class="btn">Ашу</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
