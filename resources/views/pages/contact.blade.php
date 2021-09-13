@extends('layouts.master')

@section('content')

<div class="form-login text-center" style="padding: 100px 0px">
    <div class="title">
        <h3 style="color: #ea3a3c; font-size: 40px">Liên hệ</h3>
    </div>
    <div class="form mt-5" style="width: 500px; margin: 0 auto; margin-top: 40px" >
        <form action="{{route('handle_contact')}}" method="POST">
            @csrf
            <div class="form-group text-left" >
                <label for="ten" style="font-size:15px" >Tên</label>
                <input type="text" name="ten" required class="form-control" placeholder="Nhập tên" id="ten">
              </div>
            <div class="form-group text-left" >
              <label for="email" style="font-size:15px" >Email</label>
              <input type="email" name="email" required class="form-control" placeholder="Nhập email" id="email">
            </div>
            <div class="form-group text-left" >
                <label for="noidung" style="font-size:15px" >Câu hỏi</label>
                <textarea name="noidung" id="noidung" class="form-control" required cols="30" rows="10"></textarea>
            </div>
            @isset($error)
                <p style="color:red; text-align:left; padding-bottom:4px; font-size:20px">{{$error}}</p>
            @endisset
            @isset($success)
                <p style="color:green; text-align:left; padding-bottom:4px; font-size:20px">{{$success}}</p>
            @endisset
            <button type="submit" class="btn btn-primary" style="float:right">Submit</button>
          </form>
    </div>
</div>

@endsection