<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Магазин Buzz</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #000;
        }
        .navbar-brand, .nav-link {
            color: #28a745 !important;
        }
        .hero {
            background-color: #28a745;
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .footer {
            background-color: #000;
            color: #28a745;
            text-align: center;
            padding: 20px 0;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="#">Buzz</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#about">О нас</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#shop">Магазин</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#orders">Заказы</a>
            </li>
        </ul>
    </div>
</nav>

<div class="hero">
    <h1>Добро пожаловать в магазин Buzz!</h1>
    <p>Лучшие товары по лучшим ценам</p>
    <a href="{{route('shop')}}" class="btn btn-light">Перейти в магазин</a>
</div>

<div class="container mt-5" id="about">
    <h2>О нас</h2>
    <p>Мы - магазин Buzz, который предлагает широкий ассортимент товаров для вашего удобства и удовольствия. Наша цель - предоставить вам лучший сервис и качественные продукты.</p>
</div>

<div class="container mt-5" id="shop">
    <h2>Магазин</h2>
    <p>Здесь вы найдете все, что вам нужно.</p>
</div>

<div class="container mt-5" id="orders">
    <h2>Заказы</h2>
    <p>Отслеживайте свои заказы и получайте уведомления о статусе доставки.</p>
</div>

<footer class="footer mt-5">
    <p>&copy; 2023 Магазин Buzz. Все права защищены.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
