@extends('layouts.main') <!-- Предполагается, что ваш базовый шаблон называется main.blade.php -->

@section('content')
    <div class="hero">
        <h1>Магазин</h1>
        <p>Добро пожаловать в наш магазин электроники! Здесь вы найдете широкий ассортимент товаров по доступным ценам.</p>
    </div>
    <div class="container mt-5">
        <h2>Наши товары</h2>

        <!-- Выпадающий список для сортировки -->
        <div class="form-group">
            <label for="sortSelect">Сортировать по:</label>
            <select id="sortSelect" class="form-control">
                <option value="asc">По возрастанию цены</option>
                <option value="desc">По убыванию цены</option>
            </select>
        </div>

        <div class="row" id="product-container"></div>
    </div>

    <script>
        let products = []; // Хранение загруженных продуктов

        async function fetchProducts() {
            try {
                const response = await fetch('/api/products'); // Замените на ваш API-эндпоинт
                const data = await response.json();
                products = data.products; // Сохраняем продукты в переменной
                displayProducts(products); // Отображаем продукты
            } catch (error) {
                console.error('Ошибка:', error);
            }
        }

        function displayProducts(products) {
            const container = document.getElementById('product-container');
            container.innerHTML = ''; // Очищаем контейнер перед добавлением новых карточек
            products.forEach(product => {
                const card = document.createElement('div');
                card.className = 'col-md-4 mb-4'; // Колонка для Bootstrap
                card.innerHTML = `
                <div class="card" style="cursor: pointer;">
                    <div class="card-body">
                        <h5 class="card-title">${product.name}</h5>
                        <p class="card-text">${product.description}</p>
                        <p class="price">${product.price} ₽</p>
                    </div>
                </div>
            `;
                container.appendChild(card);
            });
        }

        function sortProducts(order) {
            const sortedProducts = [...products].sort((a, b) => {
                return order === 'asc' ? a.price - b.price : b.price - a.price;
            });
            displayProducts(sortedProducts); // Отображаем отсортированные продукты
        }

        document.addEventListener('DOMContentLoaded', function() {
            fetchProducts(); // Загружаем продукты при загрузке страницы

            // Обработчик изменения выбора сортировки
            document.getElementById('sortSelect').addEventListener('change', function() {
                const selectedValue = this.value;
                sortProducts(selectedValue); // Сортируем продукты по выбранному значению
            });
        });
    </script>

    <style>
        .hero {
            background-color: #28a745; /* Зеленый цвет */
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .card {
            transition: background 0.3s; /* Плавный переход фона */
        }
        .card:hover {
            background: rgba(0, 0, 0, 0.05); /* Затемнение фона при наведении */
        }
    </style>
@endsection
