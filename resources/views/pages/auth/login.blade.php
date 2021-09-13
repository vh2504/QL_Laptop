@extends('layouts.master')

@section('content')

<div class="form-login text-center" style="padding: 100px 0px">
    <div class="title">
        <h3 style="color: #ea3a3c; font-size: 40px">Đăng nhập</h3>
    </div>
    <div class="form mt-5" style="width: 500px; margin: 0 auto; margin-top: 40px" >
        <form action="{{route('dangnhap')}}" method="POST">
            @csrf
            <div class="form-group text-left" >
              <label for="email" style="font-size:15px" >Email</label>
              <input type="email" name="email" required class="form-control" placeholder="Nhập email" id="email">
            </div>
            <div class="form-group text-left">
              <label for="pwd" style="font-size:15px">Mật khẩu:</label>
              <input type="password" name="password"  class="form-control" placeholder="Nhập mật khẩu" id="pwd">
            </div>
            @isset($error)
                <p style="color:red; text-align:left; padding-bottom:4px">{{$error}}</p>
            @endisset
           
            <div class="form-group form-check text-left ">
              <label class="form-check-label">
                <a href="" ><i style="color:blue; font-size:14px"> Quên mật khẩu</i></a>
              </label>
            </div>
            <button type="submit" class="btn btn-primary" style="float:right">Submit</button>
          </form>
    </div>
</div>

@endsection