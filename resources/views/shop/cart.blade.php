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
        /* Стили для таблицы корзины */
        .cart-table {
            width: 100%;
            border-collapse: collapse;
        }
        .cart-table th, .cart-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .cart-table th {
            background-color: #f2f2f2;
        }
        .btn-remove {
            color: red;
            cursor: pointer;
        }
        .btn-remove:hover {
            text-decoration: underline;
        }
    </style>

    <div class="hero">
        <h1>Корзина</h1>
        <p>Ваши товары, готовые к оформлению заказа.</p>
    </div>

    <div class="container mt-5">
        <h2>Товары в корзине</h2>

        <table class="cart-table">
            <thead>
            <tr>
                <th>Товар</th>
                <th>Цена</th>
                <th>Количество</th>
                <th>Итого</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody id="cart-items">
            <!-- Здесь будут отображаться товары в корзине -->
            </tbody>
        </table>

        <div class="mt-4">
            <h4>Итоговая сумма: <span id="total-price">0</span> ₽</h4>
            <button class="btn btn-success">Оформить заказ</button>
        </div>
    </div>

    <script>
        // Пример данных о товарах в корзине
        let cartItems = await fetch(`/api/cart`)['cart'];
        //     [
        //     { id: 1, name: 'Товар 1', price: 1000, quantity: 2 },
        //     { id: 2, name: 'Товар 2', price: 1500, quantity: 1 },
        //     { id: 3, name: 'Товар 3', price: 2000, quantity: 1 }
        // ];

        // Функция для отображения товаров в корзине
        function displayCartItems() {
            const cartContainer = document.getElementById('cart-items');
            cartContainer.innerHTML = ''; // Очищаем контейнер
            let total = 0;

            cartItems.forEach(item => {
                const totalPrice = item.price * item.quantity;
                total += totalPrice;

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.name}</td>
                    <td>${item.price} ₽</td>
                    <td>
                        <input type="number" value="${item.quantity}" min="1" data-id="${item.id}" class="quantity-input">
                    </td>
                    <td>${totalPrice} ₽</td>
                    <td><span class="btn-remove" data-id="${item.id}">Удалить</span></td>
                `;
                cartContainer.appendChild(row);
            });

            document.getElementById('total-price').innerText = total;
        }

        // Обработчик изменения количества товара
        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('quantity-input')) {
                const id = parseInt(e.target.getAttribute('data-id'));
                const quantity = parseInt(e.target.value);
                const item = cartItems.find(item => item.id === id);
                if (item) {
                    item.quantity = quantity;
                    displayCartItems(); // Обновляем отображение корзины
                }
            }
        });

        // Обработчик удаления товара
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-remove')) {
                const id = parseInt(e.target.getAttribute('data-id'));
                cartItems = cartItems.filter(item => item.id !== id);
                displayCartItems(); // Обновляем отображение корзины
            }
        });

        // Инициализация при загрузке страницы
        document.addEventListener('DOMContentLoaded', function() {
            displayCartItems();
        });
    </script>
@endsection
