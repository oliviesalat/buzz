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
        let products = [];

        async function fetchCartItems() {
            const url = '/cart';
            try {
                const response = await fetch(url);
                const data = await response.json();

                displayCartItems(data);

            } catch (error) {
                console.error('Ошибка при загрузке продуктов:', error);
                document.getElementById('cart-items').innerHTML =
                    '<p>Не удалось загрузить продукты. Пожалуйста, попробуйте позже.</p>';
            }
        }

        async function getProduct(product_id) {
            let url = `/api/products/${product_id}`;
            try {
                const response = await fetch(url);
                const product = await response.json();
                console.log('92', product['product']);
                return product['product'];
            } catch (error) {
                console.error('Ошибка при загрузке продуктов:', error);
                document.getElementById('cart-items').innerHTML =
                    '<p>Не удалось загрузить продукт. Пожалуйста, попробуйте позже.</p>';
            }

        }


        async function displayCartItems(cartItems) {
            const cartContainer = document.getElementById('cart-items');
            cartContainer.innerHTML = '';
            let total = 0;

            for (const item of cartItems) {
                //cartItems.forEach(async item => {
                const product = await getProduct(item['product_id']);
                console.log('112', product);
                const totalProductPrice = product['price'] * item['count'];
                console.log('totalProductPrice', totalProductPrice);
                total += totalProductPrice;

                const row = document.createElement('tr');

                row.innerHTML = `
                    <td><a href="/shop/${product['id']}" >${product['name']}</a></td>
                    <td>${product['price']} ₽</td>
                    <td>
                        <input type="number" value="${item.count}" min="1" data-id="${item['product_id']}" class="quantity-input">
                    </td>
                    <td>${totalProductPrice} ₽</td>
                    <td><span class="btn-remove" data-id="${item['product_id']}">Удалить</span></td>
                `;
                cartContainer.appendChild(row);
            }
            console.log('total', total);
            document.getElementById('total-price').innerText = total;
        }

        document.addEventListener('input', function (event) {
            if (event.target.classList.contains('quantity-input')) {
                const id = parseInt(event.target.getAttribute('data-id'));
                console.log(id);
                const quantity = parseInt(event.target.value);
                console.log(quantity);
                updateCartItem(id, quantity);
            }
        });

        function updateCartItem(productId, count) {
            fetch(`/cart/${productId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({count: count}),
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Ошибка при обновлении товара');
                    }
                    return fetchCartItems();
                })
                .catch(error => console.error('Ошибка:', error));
        }


        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('btn-remove')) {
                const id = parseInt(e.target.getAttribute('data-id'));
                deleteCartItem(id);
            }
        });


        function deleteCartItem(productId) {
            fetch(`/cart/${productId}`, {
                method: 'DELETE',
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Ошибка при удалении товара');
                    }
                    return fetchCartItems();
                })
                .catch(error => console.error('Ошибка:', error));
        }


        document.addEventListener('DOMContentLoaded', function () {
            fetchCartItems();
        });
    </script>
@endsection
