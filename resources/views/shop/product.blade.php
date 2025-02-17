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

                addToCart(product);

            } catch (error) {
                console.error('Ошибка при загрузке продукта:', error);
                const container = document.querySelector('.product-container');
                if (container) {
                    container.innerHTML = '<p>Ошибка загрузки продукта.</p>';
                }
            }
        }

        function addToCart(product) {
            const form = document.createElement('form');
            form.action = "{{ route('store') }}";
            form.method = "post";

            const input = document.createElement('input');
            input.type = "hidden";
            input.name = "product_id";
            input.value = product.id;

            const submitButton = document.createElement('input');
            submitButton.type = "submit";
            submitButton.value = "Добавить в корзину";
            submitButton.classList.add("add-to-cart-btn");
            submitButton.setAttribute('data-product-id', product.id);

            form.appendChild(input);
            form.appendChild(submitButton);


            document.querySelector('.product-container').appendChild(form);
            form.addEventListener('submit', async function (event) {
                event.preventDefault();

                const formData = new FormData(form);

                try {
                    const response = await fetch(form.action, {
                        method: form.method,
                        body: formData,
                        headers: {
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Ошибка сети');
                    }

                    const data = await response.json();
                    window.location.href = `/shop/${product.id}`;
                } catch (error) {
                    console.error('Ошибка при отправке формы:', error);
                }
            });
        }

        fetchProduct();
    </script>

@endsection
