@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    @foreach($product as $item)
      <div class="d-flex justify-content-center align-content-center" style="width: 50rem; height: 20rem; border: 1px solid grey; border-radius: 10px; margin: 10px">
        <img src="{{$item->img}}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{$item->name}}</h5>
          <p class="card-text">{{$item->price}} рублей</p>
          <p class="card-text">{{$item->description}}</p>
          <a href="{{route('product', $item->id_product)}}" class="btn btn-primary">Перейти</a>
          <a href="{{route('editProductView',  ['id'=>$item->id_product])}}" class="btn btn-primary">Обновить</a>
        </div>
      </div>
    @endforeach
  </div>

  <form class="mb-5" method="post" action="{{route('addProduct')}}" enctype="multipart/form-data">
      @csrf
      <div class="card col-4">
          <div class="card-body">
              <h5 class="card-title">Добавление товара</h5>
              <div class="mb-3">
                  <label for="id_category" class="form-label">Выбор категории</label>
                  <select class="form-select" name="id_category" id="id_category">
                      @foreach($categories as $a)
                          <option value="{{$a->id_category}}">{{$a->name}}</option>
                      @endforeach
                  </select>
              </div>

              <div class="mb-3">
                  <label for="nameProduct" class="form-label">Ввод названия товара</label>
                  <input type="text" class="form-control" id="nameProduct" name="nameProduct" required>
              </div>

              <div class="mb-3">
                  <label for="costProduct" class="form-label">Ввод цены товара</label>
                  <input type="text" class="form-control" id="costProduct" name="costProduct" required>
              </div>

              <div class="mb-3">
                  <label for="description" class="form-label">Ввод описания</label>
                  <input type="text" class="form-control" id="description" name="description" required>
              </div>

              <div class="mb-3">
                  <label for="imgProduct" class="form-label">Ввод ссылки на изображение</label>
                  <input type="text" class="form-control" id="imgProduct" name="imgProduct" required>
              </div>

              <button type="submit" class="btn btn-primary">Добавить</button>
              <p>{{session('messageAddProduct')}}</p>
          </div>
      </div>
  </form>

  <form class="mt-5" method="post" action="{{route('dellProduct')}}">
    @csrf
    @method('DELETE')
    <div class="card" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title">Удаление товара</h5>
        <select class="form-select" name="id_product">
          @foreach($product as $a)
            <option value="{{$a->id_product}}">{{$a->name}}</option>
          @endforeach
        </select>

        <button type="submit" class="btn btn-primary">Удалить</button>
        <p>{{session('messageDellProduct')}}</p>
      </div>
    </div>
  </form>  

  <form method="post" action="{{route('addCategory')}}">
    @csrf
    <div class="card" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title">Добавленеи категории</h5>
        <div class="mb-3">
          <label for="nameCategory" class="form-label">Ввод имени категории</label>
          <input type="text" class="form-control" id="nameCategory" name="nameCategory" required>
        </div>

        <button type="submit" class="btn btn-primary">Добавить</button>
        <p>{{session('messageAddCategory')}}</p>
      </div>
    </div>
  </form>

  <form class="mt-5" method="post" action="{{route('dellCategory')}}">
    @csrf
    @method('DELETE')
    <div class="card" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title">Удаление категории</h5>
        <select class="form-select" name="id_category">
          @foreach($categories as $a)
            <option value="{{$a->id_category}}">{{$a->name}}</option>
          @endforeach
        </select>

        <button type="submit" class="btn btn-primary">Удалить</button>
        <p>{{session('messageDellCategory')}}</p>
      </div>
    </div>
  </form>    
</div>


@endsection
