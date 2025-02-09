@extends('layouts.main') <!-- Предполагается, что ваш базовый шаблон называется main.blade.php -->

@section('content')


    <div class="hero">
        <h1>Магазин</h1>
        <p>Добро пожаловать в наш магазин электроники! Здесь вы найдете широкий ассортимент товаров по доступным ценам.</p>
    </div>
    <div class="container mt-5">
        <h2>Наши товары</h2>

        <!-- Выпадающий список для сортировки -->
        <div class="form-group d-flex align-items-center justify-content-end">
            <label for="sortSelect" class="mr-2 mb-0">Сортировать по:</label>
            <select id="sortSelect" class="form-control" style="width: 200px;">
                <option value="default">По умолчанию</option>
                <option value="asc">По возрастанию цены</option>
                <option value="desc">По убыванию цены</option>
            </select>
        </div>

        <!-- Контейнер для карточек товаров -->
        <div class="row" id="product-container"></div>

        <!-- Контейнер для переключателей страниц -->
        <div id="pagination-controls" class="mt-4"></div>
    </div>

    <script>
        let products = []; // Хранение товаров текущей страницы
        let currentSort = 'default'; // Текущий порядок сортировки

        // Функция для получения товаров по странице
        async function fetchProducts(page = 1) {
            try {
                const response = await fetch(`/api/products?page=${page}`); // Запрашиваем нужную страницу
                if (!response.ok) {
                    throw new Error('Сеть не отвечает');
                }
                const data = await response.json();
                // Сохраняем товары текущей страницы
                products = data.products.data;
                // Обновляем переключатели страниц, передавая все данные пагинации
                displayPagination(data.products);
                // Отображаем товары, сортируя по выбранному порядку
                sortProducts(currentSort);
            } catch (error) {
                console.error('Ошибка при загрузке продуктов:', error);
                document.getElementById('product-container').innerHTML =
                    '<p>Не удалось загрузить продукты. Пожалуйста, попробуйте позже.</p>';
            }
        }

        // Функция для отображения товаров
        function displayProducts(productsToShow) {
            const container = document.getElementById('product-container');
            container.innerHTML = ''; // Очищаем контейнер перед добавлением карточек
            if (productsToShow.length === 0) {
                container.innerHTML = '<p>Нет доступных продуктов.</p>';
                return;
            }
            productsToShow.forEach(product => {
                const card = document.createElement('div');
                card.className = 'col-md-4 mb-4';
                card.innerHTML = `
                    <a href="/shop/${product.id}" class="card" style="text-decoration: none; color: inherit;">
                        <div class="card-body">
                            <h5 class="card-title">${product.name}</h5>
                            <p class="card-text">${product.description}</p>
                            <p class="price">${product.price} ₽</p>
                            <p class="category">${product.category}</p>
                        </div>
                    </a>
                `;
                container.appendChild(card);
            });
        }

        // Функция для сортировки товаров
        function sortProducts(order) {
            currentSort = order; // Обновляем глобальную переменную сортировки
            let sortedProducts;
            if (order === 'asc') {
                sortedProducts = [...products].sort((a, b) => a.price - b.price);
            } else if (order === 'desc') {
                sortedProducts = [...products].sort((a, b) => b.price - a.price);
            } else {
                sortedProducts = products; // По умолчанию – оригинальный порядок
            }
            displayProducts(sortedProducts);
        }

        // Функция для отображения переключателей страниц
        function displayPagination(paginationData) {
            const paginationContainer = document.getElementById('pagination-controls');
            let paginationHTML = `<nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">`;

            paginationData.links.forEach(link => {
                // Определяем классы для активного и неактивного элементов
                const activeClass = link.active ? "active" : "";
                const disabledClass = link.url === null ? "disabled" : "";
                const label = link.label;
                let pageNumber = "";
                if (link.url) {
                    // Извлекаем номер страницы из URL
                    const url = new URL(link.url);
                    pageNumber = url.searchParams.get("page");
                }
                paginationHTML += `
                    <li class="page-item ${activeClass} ${disabledClass}">
                        <a class="page-link" href="#" data-page="${pageNumber}">${label}</a>
                    </li>`;
            });

            paginationHTML += `</ul></nav>`;
            paginationContainer.innerHTML = paginationHTML;

            // Вешаем обработчики кликов на ссылки пагинации
            const links = paginationContainer.querySelectorAll('.page-link');
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const page = this.getAttribute('data-page');
                    if (page) {
                        fetchProducts(page);
                    }
                });
            });
        }

        // Инициализация при загрузке страницы
        document.addEventListener('DOMContentLoaded', function() {
            fetchProducts(); // Загружаем первую страницу товаров

            // Обработчик изменения сортировки
            document.getElementById('sortSelect').addEventListener('change', function() {
                sortProducts(this.value);
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
            transition: background 0.3s;
        }
        .card:hover {
            background: rgba(0, 0, 0, 0.05);
        }
    </style>
@endsection
