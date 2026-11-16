@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Оформление заказа</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Товар</th>
                <th>Цена</th>
                <th>Количество</th>
                <th>Сумма</th>
            </tr>
        </thead>
        <tbody>
            @foreach($basketItems as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->product->price }} ₽</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->product->price * $item->quantity }} ₽</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-end mb-4">
        <h4>Итого: {{ $total }} ₽</h4>
    </div>

    <form action="{{ route('checkout.confirm') }}" method="POST" class="card p-4">
        @csrf
        <div class="mb-3">
            <label for="password" class="form-label">Подтвердите пароль для оформления заказа</label>
            <input type="password"
                   class="form-control @error('password') is-invalid @enderror"
                   id="password"
                   name="password"
                   required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Сформировать заказ</button>
        <a href="{{ route('cart.index') }}" class="btn btn-secondary">Назад в корзину</a>
    </form>
</div>
@endsection