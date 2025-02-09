@extends('layouts.main')
@section('content')

<div class="hero">
    <h1>Добро пожаловать в магазин Buzz!</h1>
    <p>Лучшие товары по лучшим ценам</p>
    <a href="{{route('shop')}}" class="btn btn-light">Перейти в магазин</a>
</div>

<div class="container mt-5" id="about">
    <h2><a href="{{route('aboutpage')}}">О нас</a></h2>
    <p>Мы - магазин Buzz, который предлагает широкий ассортимент товаров для вашего удобства и удовольствия. Наша цель - предоставить вам лучший сервис и качественные продукты.</p>
</div>

<div class="container mt-5" id="shop">
    <h2 ><a href="{{route('shop')}}">Магазин</a></h2>
    <p>Здесь вы найдете все, что вам нужно.</p>
</div>

<div class="container mt-5" id="orders">
    <h2>Заказы</h2>
    <p>Отслеживайте свои заказы и получайте уведомления о статусе доставки.</p>
</div>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection


