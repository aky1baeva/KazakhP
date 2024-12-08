<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding-top: 20px;
        }

        .card {
            transition: transform 0.3s ease-in-out;
            cursor: pointer;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-title {
            font-weight: bold;
        }

        a.text-decoration-none {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <h1 class="text-center mb-4">Admin Panel</h1>
    <div class="row g-3">
        <!-- Карточки для управления разделами -->
        <div class="col-md-4">
            <a href="tasks.php" class="card shadow-sm text-center text-decoration-none">
                <div class="card-body">
                    <i class="fas fa-tasks fa-3x text-primary"></i>
                    <h5 class="card-title mt-3">Manage Tasks</h5>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="book_admin.php" class="card shadow-sm text-center text-decoration-none">
                <div class="card-body">
                    <i class="fas fa-book fa-3x text-success"></i>
                    <h5 class="card-title mt-3">Manage Books</h5>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="audio_book_admin.php" class="card shadow-sm text-center text-decoration-none">
                <div class="card-body">
                    <i class="fas fa-headphones fa-3x text-info"></i>
                    <h5 class="card-title mt-3">Manage Audio Books</h5>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="movies_admin.php" class="card shadow-sm text-center text-decoration-none">
                <div class="card-body">
                    <i class="fas fa-film fa-3x text-warning"></i>
                    <h5 class="card-title mt-3">Manage Movies</h5>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="dictionary.php" class="card shadow-sm text-center text-decoration-none">
                <div class="card-body">
                    <i class="fas fa-book fa-3x text-danger"></i>
                    <h5 class="card-title mt-3">Manage Dictionary</h5>
                </div>
            </a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
