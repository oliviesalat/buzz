@extends('layouts.main')

@section('content')
    <style>
        .hero {
            background-color: #28a745;
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
        /* Курсор при наведении на элементы меню */
        #category-menu li {
            cursor: pointer;
        }
        /* Стили для выбранного пункта меню */
        #category-menu li.active {
            background-color: #28a745;
            color: white;
            border-color: #28a745;
        }
        /* Стили для активного пункта пагинации */
        .pagination .page-item.active .page-link {
            background-color: #28a745;
            border-color: #28a745;
            color: white;
        }
        /* Для невыделенных (неактивных) кнопок пагинации задаем черный цвет текста */
        .pagination .page-link {
            color: black;
        }
        /* Стили для режима списка */
        .list-view .card {
            display: flex;
            flex-direction: row;
            margin-bottom: 15px;
        }
        .list-view .card-body {
            flex: 1;
        }
    </style>
    <div class="hero">
        <h1>Магазин</h1>
        <p>Добро пожаловать в наш магазин электроники! Здесь вы найдете широкий ассортимент товаров по доступным ценам.</p>
    </div>

    <div class="container mt-5">
        <div class="row">
            <!-- Боковое меню категорий -->
            <div class="col-md-3">
                <h3>Категории</h3>
                <ul class="list-group" id="category-menu">
                    <li class="list-group-item active" data-category="all">Все товары</li>
                    <li class="list-group-item" data-category="mobiles">Mobiles</li>
                    <li class="list-group-item" data-category="computers">Computers</li>
                    <li class="list-group-item" data-category="notebooks">Notebooks</li>
                    <li class="list-group-item" data-category="respect">Respect</li>
                </ul>
            </div>

            <!-- Основной контент с товарами -->
            <div class="col-md-9">
                <h2>Наши товары</h2>

                <!-- Переключатель отображения -->
                <div class="d-flex justify-content-end mb-3">
                    <button id="gridView" class="btn btn-outline-primary mr-2">
                        <i class="fas fa-th"></i> <!-- Иконка для плиток -->
                    </button>
                    <button id="listView" class="btn btn-outline-secondary">
                        <i class="fas fa-list"></i> <!-- Иконка для списка -->
                    </button>
                </div>

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
        </div>
    </div>

    <script>

        let products = [];
        let currentSort = 'default';
        let selectedCategory = 'all';
        let currentView = 'grid';


        async function fetchProducts(page = 1) {
            let url = `/api/products?page=${page}`;
            if (selectedCategory !== 'all') {
                url += `&category=${selectedCategory}`;
            }

            try {
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error('Сеть не отвечает');
                }
                const data = await response.json();
                products = data.products.data;
                displayPagination(data.products);
                sortProducts(currentSort);
            } catch (error) {
                console.error('Ошибка при загрузке продуктов:', error);
                document.getElementById('product-container').innerHTML =
                    '<p>Не удалось загрузить продукты. Пожалуйста, попробуйте позже.</p>';
            }
        }


        function displayProducts(productsToShow) {
            const container = document.getElementById('product-container');
            container.innerHTML = '';
            if (productsToShow.length === 0) {
                container.innerHTML = '<p>Нет доступных продуктов.</p>';
                return;
            }
            productsToShow.forEach(product => {
                const card = document.createElement('div');
                card.className = currentView === 'grid' ? 'col-md-4 mb-4' : 'col-12 mb-3 card list-view';
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


        function sortProducts(order) {
            currentSort = order;
            let sortedProducts;
            if (order === 'asc') {
                sortedProducts = [...products].sort((a, b) => a.price - b.price);
            } else if (order === 'desc') {
                sortedProducts = [...products].sort((a, b) => b.price - a.price);
            } else {
                sortedProducts = products;
            }
            displayProducts(sortedProducts);
        }


        function displayPagination(paginationData) {
            const paginationContainer = document.getElementById('pagination-controls');
            let paginationHTML = `<nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">`;

            paginationData.links.forEach(link => {
                const activeClass = link.active ? "active" : "";
                const disabledClass = link.url === null ? "disabled" : "";
                const label = link.label;
                let pageNumber = "";
                if (link.url) {
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


        document.addEventListener('DOMContentLoaded', function() {
            fetchProducts();

            document.getElementById('sortSelect').addEventListener('change', function() {
                sortProducts(this.value);
            });

            const categoryMenu = document.getElementById('category-menu');
            categoryMenu.addEventListener('click', function(e) {
                if (e.target && e.target.nodeName === "LI") {
                    const items = categoryMenu.querySelectorAll('li');
                    items.forEach(item => item.classList.remove('active'));
                    e.target.classList.add('active');
                    selectedCategory = e.target.getAttribute('data-category');
                    fetchProducts(1);
                }
            });


            document.getElementById('gridView').addEventListener('click', function() {
                currentView = 'grid';
                displayProducts(products);
            });

            document.getElementById('listView').addEventListener('click', function() {
                currentView = 'list';
                displayProducts(products);
            });
        });
    </script>
@endsection
