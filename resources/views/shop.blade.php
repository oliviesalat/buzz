@extends('layouts.main')
@section('content')

<div class="container mt-5" id="products">
    <h2>Наши продукты</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="https://via.placeholder.com/300" class="card-img-top" alt="Продукт 1">
                <div class="card-body">
                    <h5 class="card-title">Продукт 1</h5>
                    <p class="card-text">Описание продукта 1. Отличное качество и доступная цена.</p>
                    <a href="#" class="btn btn-success">Купить</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="https://via.placeholder.com/300" class="card-img-top" alt="Продукт 2">
                <div class="card-body">
                    <h5 class="card-title">Продукт 2</h5>
                    <p class="card-text">Описание продукта 2. Идеально подходит для повседневного использования.</p>
                    <a href="#" class="btn btn-success">Купить</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="https://via.placeholder.com/300" class="card-img-top" alt="Продукт 3">
                <div class="card-body">
                    <h5 class="card-title">Продукт 3</h5>
                    <p class="card-text">Описание продукта 3. Высокая производительность и надежность.</p>
                    <a href="#" class="btn btn-success">Купить</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
