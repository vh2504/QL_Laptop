@extends('layouts.master')



@section('content')
<section class="box-main1" >
    <form action="{{route('update-cart')}}" method="post">
    @csrf
        <div class="container" style="width:100%;">
            <h1 style="margin: 40px 0px;text-align: center; color: red">Giỏ hàng</h1>
            @if (session('message_delete'))
                <h3 style="margin: 20px 0px;; color: green">{{session('message_delete')}}</h3>
            @endif
            @if (session('message_update'))
                <h3 style="margin: 20px 0px;; color: green">{{session('message_update')}}</h3>
            @endif
            <div class="row" >
                <div class="col-lg-4" style="font-size:20px;">Sản phẩm</div>
                <div class="col-lg-2" style="font-size:20px;">Giá</div>
                <div class="col-lg-2" style="font-size:20px;">Số lượng</div>
                <div class="col-lg-2" style="font-size:20px;">Thành tiền</div>
                <div class="col-lg-2" style="font-size:20px;"></div>
            </div>
            @foreach ($list_products as $item)
                <div class="row" style="margin-top: 20px">
                    <div class="col-lg-4">
                        <a href="{{route('detail', ['id'=>$item->sanpham_id
                        ])}}" style="font-size:17px;">{{$item->sanpham->tensanpham}}</a>
                    </div>
                    <div class="col-lg-2" style="font-size:17px;">
                        {{number_format($item->sanpham->giasale)}}
                    </div>
                    <div class="col-lg-2" style="font-size:17px;">
                        <input type="number" name="soluong<?php echo '-'.$item->sanpham_id.'-'.$item->giohang_id ;?>" style="width:60px" value="{{$item->soluong}}">
                    </div>
                    <div class="col-lg-2" style="font-size:17px;">
                        {{ number_format($item->sanpham->giasale * $item->soluong)}}
                    </div>
                    <div class="col-lg-2" style="font-size:17px;">
                        {{-- <a class="btn btn-primary" href=""><i class="fa fa-pencil-square-o" aria-hidden="true" style="color: white"></i></a> --}}
                        <a class="btn btn-danger" href="{{route('delete-product', ['giohang_id' => $item->giohang_id,'sanpham_id' => $item->sanpham_id])}}"><i class="fa fa-times" aria-hidden="true" style="color: white"></i></a>
                    </div>
                </div>
            @endforeach
            
        </div>
        <button class="btn btn-primary" style="margin: 30px 0px; position: right" type="submit">Cập nhật giỏ hàng</button>
        <a href="{{route('dat-hang-from-cart')}}" class="btn btn-danger" style="margin: 30px 0px; position: right">Đặt hàng ngay</a>
    </form>
    
    
</section>


@endsection



























