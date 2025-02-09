@extends('layouts.main')

@section('content')
    <div class="hero">
        <h1 id="product-name"></h1>
    </div>
    <div class="container mt-5">
        <div class="product-container mt-4">
            <p id="product-description"></p>
            <p id="product-price" class="h4"></p>
        </div>
        <a href="{{ route('shop') }}" class="btn btn-success mt-3">Назад в магазин</a> <!-- Кнопка "Назад" -->
    </div>

    <script>
        async function fetchProduct() {
            // Получаем ID продукта из URL
            const productId = window.location.pathname.split('/').pop();

            try {
                // Делаем запрос к API
                const response = await fetch(`/api/products/${productId}`);
                if (!response.ok) {
                    throw new Error('Ошибка сети');
                }

                // Получаем данные продукта
                const data = await response.json();
                const product = data.product;

                // Обновляем HTML с данными продукта
                document.getElementById('product-name').textContent = product.name;
                document.getElementById('product-description').textContent = product.description;
                document.getElementById('product-price').textContent = `${product.price} ₽`;
            } catch (error) {
                console.error('Ошибка при загрузке продукта:', error);
                document.querySelector('.product-container').innerHTML = '<p>Ошибка загрузки продукта.</p>';
            }
        }

        // Вызываем функцию для получения данных продукта
        fetchProduct();
    </script>
@endsection
