@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ваша корзина</h1>

    @if($cartItems->isEmpty())
        <p>Корзина пуста</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Товар</th>
                    <th>Цена</th>
                    <th>Количество</th>
                    <th>Сумма</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }} руб.</td>
                    <td>
                        <form action="{{ route('cart.update', $product->id_product) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="number" name="quantity" value="{{ $product->pivot->quantity }}" min="1" style="width: 60px;">
                            <button type="submit" class="btn btn-sm btn-primary">Обновить</button>
                        </form>
                    </td>
                    <td>{{ $product->price * $product->pivot->quantity }} руб.</td>
                    <td>
                        <form action="{{ route('cart.remove', $product->id_product) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Итого: {{ $totalPrice }} руб.</h3>
        
        <div class="text-end mt-3">
            <a href="{{ route('checkout') }}" class="btn btn-success mt-2">Оформить заказ</a>
        </div>
    @endif
</div>
@endsection
