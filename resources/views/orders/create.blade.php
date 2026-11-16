@extends('layouts.app')

@section('content')
<div class="container">
    <form id="orderForm">
        @csrf
        <h3>Товары в заказе</h3>
        <ul>
            @foreach($cartItems as $item)
                <li>{{ $item->product->name }} × {{ $item->quantity }} ({{ $item->product->price * $item->quantity }} ₽)</li>
            @endforeach
        </ul>
        <input type="password" name="password" placeholder="Пароль для подтверждения" required>
        <button type="submit">Сформировать заказ</button>
    </form>

    <script>
    document.getElementById('orderForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const res = await fetch('/orders', {
            method: 'POST',
            headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            body: JSON.stringify(Object.fromEntries(new FormData(e.target)))
        });
        const data = await res.json();
        if (!res.ok) alert(data.error);
        else window.location.href = '/orders';
    });
    </script>
</div>
@endsection
