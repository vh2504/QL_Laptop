@extends('layouts.master')

@section('content')

<div class="form-login text-center" style="padding: 100px 0px">
    <div class="title">
        <h3 style="color: #ea3a3c; font-size: 40px">Đăng ký</h3>
    </div>
    <div class="form mt-5" style="width: 500px; margin: 0 auto; margin-top: 40px" >
        <form action="{{route('dangky')}}" method="POST">
            @csrf
            <div class="form-group text-left" >
              <label for="email" style="font-size:15px" >Email</label>
              <input type="email" name="email" required class="form-control" placeholder="Nhập email" id="email">
            </div>
            <div class="form-group text-left" >
              <label for="name" style="font-size:15px" >Tên</label>
              <input type="text" name="name" required class="form-control" placeholder="Nhập tên" id="name">
            </div>
            <div class="form-group text-left">
              <label for="pwd" style="font-size:15px">Mật khẩu:</label>
              <input type="password" name="password"  class="form-control" placeholder="Nhập mật khẩu" id="pwd">
            </div>
            <div class="form-group text-left" >
              <label for="phone" style="font-size:15px" >Số điện thoại</label>
              <input type="text" name="phone" required class="form-control" placeholder="Nhập số điệnt thoại" id="phone">
            </div>
            <div class="form-group text-left" >
              <label for="address" style="font-size:15px" >Địa chỉ</label>
              <input type="text" name="address" required class="form-control" placeholder="Nhập địa chỉ" id="address">
            </div>
           
            <button type="submit" class="btn btn-primary" style="float:right">Đăng ký</button>
          </form>
    </div>
</div>

@endsection