@extends('layouts.master')


@section('content')

<section class="box-main1" style="margin-bottom: 30px">
    <h1 class="text-center" style="margin-top: 20px;">Danh mục {{$cate->ten}}</h1>
    <div class="showitem">
        <div class="row">
             @foreach ($cate->san_phams as $sp)
                <div class="col-md-3 item-product bor">
                    <a href="{{route('detail', ['id' => $sp->id])}}">
                        <img src="{{ Voyager::image($sp->anh) }}" class="" width="100%" height="180">
                    </a>
                    <div class="info-item">
                        <a href="{{route('detail', ['id' => $sp->id])}}">{{$sp->tensanpham}}</a>
                        <p><strike class="sale">{{number_format($sp->giasale, 0, '', '.') . "đ"}}</strike> <b class="price">{{number_format($sp->giaban, 0, '', '.') . "đ"}}</b></p>
                    </div>
                    <div class="hidenitem">
                        <p><a href=""><i class="fa fa-search"></i></a></p>
                        <p><a href=""><i class="fa fa-heart"></i></a></p>
                        <p><a href="{{ route('add-to-cart', ['product_id' => $sp->id]) }}"><i class="fa fa-shopping-basket"></i></a></p>
                    </div>
                </div>

                @endforeach   
            
        </div>
    </div>
</section>

@endsection