<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Настройки - Қазақ Тілін Үйрету Платформасы</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            margin-top: 30px;
        }
        .nav-tabs {
            margin-bottom: 20px;
        }
        .tab-content {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-check-label {
            font-size: 16px;
        }
        .user-image {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #ddd;
            position: relative;
        }
        .user-name {
            position: absolute;
            top: 50%;
            left: -10%;
            transform: translate(-50%, -50%);
            font-size: 16px;
            color: black;
            font-weight: bold;
        }
        .password-input {
            position: relative;
        }
        .password-input .fa-eye {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
        .btn-custom {
            background-color: #0056b3;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
        .btn-custom:hover {
            background-color: #004099;
        }
        .file-input {
            font-size: 14px;
        }
        .nav-link i {
            margin-right: 8px;
        }
        .tab-pane {
            min-height: 250px;
        }

        /* Оң жақ жоғарғы бұрыштағы профиль */
        .profile-container {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .profile-dropdown {
            display: none;
            position: absolute;
            top: 35px;
            right: 0;
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 10px;
            border-radius: 5px;
        }

        .profile-container:hover .profile-dropdown {
            display: block;
        }

        .dropdown-item {
            padding: 10px;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background-color: #f1f1f1;
        }

        /* Артқа қайту кнопкасы */
        .back-button {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<!-- Артқа қайту кнопкасы -->
<div class="container">
    <button class="btn btn-secondary back-button" onclick="goBack()">Артқа қайту</button>
</div>

<!-- Профиль бар мәзір -->
<div class="profile-container">
    <img src="https://via.placeholder.com/50" alt="User Image" class="user-image" id="profileImage">
    <div class="user-name" id="userName">Адам Аты</div>
    <div class="profile-dropdown">
        <div class="dropdown-item" onclick="goToSettings()">Настройки</div>
        <div class="dropdown-item" onclick="logout()">Выход</div>
    </div>
</div>

<div class="container">
    <h1 class="text-center mb-4">Настройки</h1>
    <!-- Бетіңіздің мазмұны келесі жерде болады -->
    <div class="nav nav-tabs" id="settingsTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="personal-data-tab" data-bs-toggle="tab" data-bs-target="#personal-data" type="button" role="tab" aria-controls="personal-data" aria-selected="true">Личные данные</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="notifications-tab" data-bs-toggle="tab" data-bs-target="#notifications" type="button" role="tab" aria-controls="notifications" aria-selected="false">Уведомления</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="contacts-tab" data-bs-toggle="tab" data-bs-target="#contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">Контакты</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button" role="tab" aria-controls="security" aria-selected="false">Безопасность</button>
        </li>
    </div>
    <div class="tab-content" id="settingsTabsContent">
        <!-- Личные данные -->
        <div class="tab-pane fade show active" id="personal-data" role="tabpanel" aria-labelledby="personal-data-tab">
            <div class="form-group">
                <label for="username">Қолданушы аты:</label>
                <input type="text" class="form-control" id="username" placeholder="Қолданушы аты">
            </div>
            <div class="form-group">
                <label for="email">Электронды пошта:</label>
                <input type="email" class="form-control" id="email" placeholder="Электронды пошта">
            </div>
        </div>
        <!-- Уведомления -->
        <div class="tab-pane fade" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="emailNotifications" checked>
                <label class="form-check-label" for="emailNotifications">Электронды пошта арқылы хабарламалар</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="smsNotifications">
                <label class="form-check-label" for="smsNotifications">SMS хабарламалар</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="pushNotifications">
                <label class="form-check-label" for="pushNotifications">Push хабарламалар</label>
            </div>
        </div>
        <!-- Контакты -->
        <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
            <div class="form-group">
                <label for="phoneNumber">Телефон нөмірі:</label>
                <input type="text" class="form-control" id="phoneNumber" placeholder="Телефон нөмірі">
            </div>
            <div class="form-group">
                <label for="address">Мекенжай:</label>
                <input type="text" class="form-control" id="address" placeholder="Мекенжай">
            </div>
        </div>
        <!-- Безопасность -->
        <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
            <div class="form-group password-input">
                <label for="currentPassword">Текущий пароль:</label>
                <input type="password" class="form-control" id="currentPassword" placeholder="Құпия сөз">
                <i class="fa fa-eye" onclick="togglePassword('currentPassword')"></i>
            </div>
            <div class="form-group password-input">
                <label for="newPassword">Жаңа құпия сөз:</label>
                <input type="password" class="form-control" id="newPassword" placeholder="Жаңа құпия сөз">
                <i class="fa fa-eye" onclick="togglePassword('newPassword')"></i>
            </div>
            <div class="form-group password-input">
                <label for="confirmNewPassword">Жаңа құпия сөзді растаңыз:</label>
                <input type="password" class="form-control" id="confirmNewPassword" placeholder="Жаңа құпия сөзді растаңыз">
                <i class="fa fa-eye" onclick="togglePassword('confirmNewPassword')"></i>
            </div>
            <button class="btn btn-warning" onclick="changePassword()">Құпия сөзді өзгерту</button>
        </div>
    </div>
    <div class="text-center mt-4">
        <button class="btn btn-custom" onclick="saveSettings()">Параметрлерді сақтау</button>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Артқа қайту функциясы
    function goBack() {
        window.history.back();
    }

    // Профиль мәзірін ашу
    function goToSettings() {
        alert('Настройки бөлімінде');
    }

    function logout() {
        alert('Выходтан шығып жатырмыз...');
    }

    // Қолданушының атын серверден алу (мысалы, API арқылы)
    function getUserInfo() {
        // Мысалы, серверге сұраныс жасау (Бұл жерде сіз өз серверіңізді қосасыз)
        // Мұнда "Адам Аты" деген қолданушының атын серверден алып келуіміз керек

        // API арқылы қолданушы мәліметтерін алу:
        // Бұл мысал - сіздің серверден қолданушы атын алу үшін API сұранысы
        fetch('/api/getUserInfo')
            .then(response => response.json())
            .then(data => {
                // Қолданушының атын көрсету
                document.getElementById('userName').textContent = data.name;
                document.getElementById('profileImage').src = data.profileImage;
            })
            .catch(error => {
                console.error('Қате орын алды:', error);
            });
    }

    // Қолданушы мәліметтерін бет жүктелген кезде алу
    window.onload = getUserInfo;
</script>
</body>
</html>
