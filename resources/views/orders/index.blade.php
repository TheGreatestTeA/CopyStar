@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($orders as $order)
    <div>
        <span>Заказ #{{$order->id_order }}</span>
        <span>Статус: {{$order->status->name }}</span>
        <ul>
            @foreach($order->orderItems as $item)
                <li>{{ $item->product->name }} × {{ $item->quantity }}</li>
            @endforeach
        </ul>
        @if(\$order->status->id_status === 1)
            <button onclick="deleteOrder({{$order->id_order }})">Удалить</button>
        @endif
    </div>
    @endforeach

    <form id="orderForm">
        @csrf
        <input type="password" name="password" placeholder="Пароль для подтверждения">
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
        else location.reload();
    });
    function deleteOrder(id) {
        if(!confirm('Удалить?')) return;
        fetch(`/orders/${id}`, {method: 'DELETE'})
            .then(() => location.reload());
    }
    </script>
</div>
@endsection
