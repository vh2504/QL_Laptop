<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\DanhMuc;
use App\SanPham;

class AuthController extends Controller
{
    public function login (Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);
        $categories = DanhMuc::with(['danh_muc_cha', 'san_phams', 'danh_muc_cons'])->get();
    
        $new_products = SanPham::limit(4)->get();
        $categories_show = Danhmuc::with(['san_phams' => function ($query) {
            $query->limit(8);
        }])->where('danhmuc_id', null)->get();

        
        if ($validator->fails())
            return view('pages.auth.login', 
                    [
                        'error' => 'Vui lòng kiểm tra lại thông tin đăng nhập !',
                        "categories" => $categories,
                        "new_products" => $new_products,
                        "categories_show" =>$categories_show
                    ]);
        
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password]))
            return view('pages.auth.login', 
                      [
                        'error' => 'Vui lòng kiểm tra lại thông tin đăng nhập !',
                        "categories" => $categories,
                        "new_products" => $new_products,
                        "categories_show" =>$categories_show
                    ]); 
        
        return view('pages.home', [
            "categories" => $categories,
            "new_products" => $new_products,
            "categories_show" =>$categories_show
        ]);
        
    }

    public function register(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ]);
        if ($validator->fails())
            return view('pages.auth.register', ['error' => 'Vui lòng kiểm tra lại thông tin']);

        User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'sdt' => $request->phone,
            'diachi' => $request->address
        ]);

        $categories = DanhMuc::with(['danh_muc_cha', 'san_phams', 'danh_muc_cons'])->get();
    
        $new_products = SanPham::limit(4)->get();
        $categories_show = Danhmuc::with(['san_phams' => function ($query) {
            $query->limit(8);
        }])->where('danhmuc_id', null)->get();

        return view('pages.home', [
            "categories" => $categories,
            "new_products" => $new_products,
            "categories_show" =>$categories_show
        ]);
    }   

    public function logout() 
    {
        Auth::logout();
        $categories = DanhMuc::with(['danh_muc_cha', 'san_phams', 'danh_muc_cons'])->get();
    
        $new_products = SanPham::limit(4)->get();
        $categories_show = Danhmuc::with(['san_phams' => function ($query) {
            $query->limit(8);
        }])->where('danhmuc_id', null)->get();
        return view('pages.auth.login', 
                [
                "categories" => $categories,
                "new_products" => $new_products,
                "categories_show" =>$categories_show
            ]); 
    }

    public function show_login_form()
    {
        $categories = DanhMuc::with(['danh_muc_cha', 'san_phams', 'danh_muc_cons'])->get();
     
        $new_products = SanPham::limit(4)->get();
        $categories_show = Danhmuc::with(['san_phams' => function ($query) {
            $query->limit(8);
        }])->where('danhmuc_id', null)->get();

        return view('pages.auth.login', [
            "categories" => $categories,
            "new_products" => $new_products,
            "categories_show" =>$categories_show
        ]);
    }

    public function show_register_form()
    {
        $categories = DanhMuc::with(['danh_muc_cha', 'san_phams', 'danh_muc_cons'])->get();
    
        $new_products = SanPham::limit(4)->get();
        $categories_show = Danhmuc::with(['san_phams' => function ($query) {
            $query->limit(8);
        }])->where('danhmuc_id', null)->get();
        return view('pages.auth.register', [
            "categories" => $categories,
            "new_products" => $new_products,
            "categories_show" =>$categories_show
        ]);
    }
}
