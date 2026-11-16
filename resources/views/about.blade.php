@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card" style="height: 32rem;">
        <div class="card-body">
            <h5 class="card-title">Заголовок карточки</h5>
            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod voluptate inventore qui autem vero quidem, minus laborum fugiat? Laudantium vero esse quaerat voluptatum beatae quis, voluptates iusto adipisci eum. Soluta. Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus ea dolorum obcaecati voluptatem exercitationem rem incidunt hic quo et ratione sunt, rerum fuga expedita tempore. Dolorem natus quisquam in id! Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos id totam possimus. Iste unde blanditiis, consequuntur suscipit non, optio, obcaecati provident quisquam ea nam quos soluta. Eaque voluptatibus aut a?</p>
        </div>
    </div>

    <div id="carouselExampleIndicators" class="carousel slide" style="margin: 10px">
        <div class="carousel-inner mx-auto">
            @foreach($product as $item)
                @if($loop->index==0)
                    <div class="carousel-item active">
                        <div class="d-block w-100 d-flex" style="width: 64rem; height: 20rem; border: 1px solid grey; border-radius: 10px;">
                            <img src="{{$item->img}}" class="card-img-top mx-auto" alt="..." style="width: 60rem">
                            <div class="card-body">
                                <h5 class="card-title">{{$item->name}}</h5>
                                <p class="card-text">{{$item->price}} рублей</p>
                                <p class="card-text">{{$item->description}}</p>
                                <a href="{{route('product', $item->id_product)}}" class="btn btn-primary">Перейти куда-нибудь</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="carousel-item">
                        <div class="d-block w-100 d-flex" style="width: 64rem; height: 20rem; border: 1px solid grey; border-radius: 10px;">
                            <img src="{{$item->img}}" class="card-img-top" alt="..." style="width: 60rem">
                            <div class="card-body">
                                <h5 class="card-title">{{$item->name}}</h5>
                                <p class="card-text">{{$item->price}} рублей</p>
                                <p class="card-text">{{$item->description}}</p>
                                <a href="{{route('product', $item->id_product)}}" class="btn btn-primary">Перейти куда-нибудь</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev" style="background-color: black; width: 50px; height: 50px; margin-top: auto; margin-bottom: auto">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Предыдущий</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next" style="background-color: black; width: 50px; height: 50px; margin-top: auto; margin-bottom: auto">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Следующий</span>
        </button>
    </div>
</div>
@endsection

