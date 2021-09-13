@extends('layouts.master')



@section('content')
<section class="box-main1" >
    <form action="{{route('handle-dat-hang-from-cart')}}" method="post">
    @csrf
        <div class="container" style="width:100%;">
            <h1 style="margin: 40px 0px;text-align: center; color: red">Chi tiết đặt hàng</h1>
            <div class="col-lg-7">
                <div class="row">
                    <div class="form-group">
                        <label for="name">Họ tên người nhận</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="phone">Số điện thoại </label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="address">Địa chỉ </label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="note" style="display:block">Ghi chú </label>
                        <textarea name="note" id="note" cols="79" rows="10" style="border-radius: 10px;"></textarea>
                    </div>
                </div>
                
            </div>
            <div class="col-lg-5" style="padding: 0px 15px;">
                <h3 style="font-size:20px;">Đơn hàng của bạn</h3>
                <div class="row" style="margin-top: 20px">
                    <div class="col-lg-8">
                        <h4>Sản phẩm</h4>
                    </div>
                    <div class="col-lg-4">
                        <h4>Thành tiền</h4>
                    </div>
                </div>
                <hr width="300px" height="30px">
                @foreach ($product_cart as $product)
                    <div class="row" style="margin-top: 20px">
                        <div class="col-lg-8">
                            <p style="font-size:15px; color: blue;">{{$product->sanpham->tensanpham}}
                                <span style="font-size:15px; color: red;"> X {{$product->soluong}}
                                </span>
                            </p>
                        </div>
                        <div class="col-lg-4">
                            <p style="font-size:15px;">{{number_format($product->sanpham->giasale * $product->soluong) }}</p>
                        </div>
                    </div>
                @endforeach
                
            </div>
        </div>
        <button type="submit" class="btn btn-danger" style="margin: 30px 0px; position: right">Đặt hàng</button>
    </form>
    
    
</section>


@endsection



























