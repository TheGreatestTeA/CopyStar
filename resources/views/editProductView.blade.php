@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Редактирование товара</h3>

    <div class="card col-4">
        <img src="{{$product->img}}" class="card-img-top" alt="...">
        <div class="card-body">
            <form method="post" action="{{route('editProduct',['id_product'=>$product->id_product])}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Название товара</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}">
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Цена товара</label>
                    <input type="text" class="form-control" id="price" name="price" value="{{$product->price}}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Описание товара</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{$product->description}}">
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Изменить фото товара</label>
                    <input class="form-control" type="file" id="image" name="image" accept="image/*">
                </div>

                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <p class="card-title">Изменение категории</p>
                        <select class="form-select" name="id_category">
                        @foreach($categories as $a)
                            <option value="{{$a->id_category}}">{{$a->name}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Сохранить</button>

                <p class="mt-2">{{session('message')}}</p>
            </form>
        </div>
    </div>
</div>
@endsection
