@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center align-content-center" style="width: 64rem; border: 1px solid grey; border-radius: 10px">

        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A6b66280b83cdf1611d547ce5796e33a51a5b5e1228da0a1fe5beb70106635ee7&width=759&height=543&lang=ru_RU&scroll=true"></script>

        <div class="card-body" style="margin-left: 10px">
            <h5 class="card-title">Адрес</h5>
            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

            <h5 class="card-title">Номер телефона</h5>
            <p class="card-text">8 999 999 99 99</p>

            <h5 class="card-title">E-mail</h5>
            <p class="card-text">lorem@mail.ru</p>
        </div>
    </div>
</div>
@endsection

