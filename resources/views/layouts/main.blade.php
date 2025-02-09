<!doctype html>
<html lang="en">
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
        #category-menu li.active {
            background-color: #28a745;
            color: white;
            border-color: #28a745;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
<a class="navbar-brand" href="{{route('mainpage')}}">Buzz</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{route('aboutpage')}}">О нас</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/shop">Магазин</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#orders">Заказы</a>
        </li>
    </ul>
</div>
</nav>
@yield('content')
<footer class="footer mt-5">
    <p>&copy; 2025 Магазин Buzz. Все права защищены.</p>
</footer>

</body>
</html>
