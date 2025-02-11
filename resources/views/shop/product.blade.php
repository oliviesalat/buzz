@extends('layouts.main')

@section('content')


    <div class="hero">
        <h1 id="product-name"></h1>
    </div>
    <div class="container mt-5">
        <div class="product-container mt-4">
            <p id="product-category"></p>
            <p id="product-description"></p>
            <p id="product-price" class="h4"></p>
        </div>
        <a href="{{ route('shop') }}" class="btn btn-success mt-3">Назад в магазин</a>
    </div>

    <script>
        async function fetchProduct() {
            const productId = window.location.pathname.split('/').pop();

            try {

                const response = await fetch(`/api/products/${productId}`);
                if (!response.ok) {
                    throw new Error('Ошибка сети');
                }


                const data = await response.json();
                const product = data.product;


                document.getElementById('product-name').textContent = product.name;
                document.getElementById('product-description').textContent = `Описание: ${product.description}`;
                document.getElementById('product-price').textContent = `Цена: ${product.price} ₽`;
                document.getElementById('product-category').textContent = `Категория: ${product.category}`;
            } catch (error) {
                console.error('Ошибка при загрузке продукта:', error);
                document.querySelector('.product-container').innerHTML = '<p>Ошибка загрузки продукта.</p>';
            }
        }

        fetchProduct();
    </script>
@endsection
