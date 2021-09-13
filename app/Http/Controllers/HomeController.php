<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DanhMuc;
use App\SanPham;
use App\LienHe;
use App\GioHang_SanPham;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = DanhMuc::with(['danh_muc_cha', 'san_phams', 'danh_muc_cons'])->get();
        $new_products = SanPham::limit(4)->get();
        $categories_show = Danhmuc::with(['san_phams' => function ($query) {
            $query->limit(8);
        }])->where('danhmuc_id', 0)->get();

        return view('pages.home', [
            "categories" => $categories,
            "new_products" => $new_products,
            "categories_show" =>$categories_show
        ]);

    }

    public function detail($id) 
    {
        $sanpham = SanPham::findOrFail($id);
        $categories = DanhMuc::with(['danh_muc_cha', 'san_phams', 'danh_muc_cons'])->get();
        $new_products = SanPham::limit(4)->get();
        $categories_show = Danhmuc::with(['san_phams' => function ($query) {
            $query->limit(8);
        }])->where('danhmuc_id', 0)->get();
        return view('pages.detail', [
            "sanpham" => $sanpham,
            "categories" => $categories,
            "new_products" => $new_products,
            "categories_show" =>$categories_show
        ]);
    }

    public function  contact_form() 
    {
        $categories = DanhMuc::with(['danh_muc_cha', 'san_phams', 'danh_muc_cons'])->get();
        $new_products = SanPham::limit(4)->get();
        $categories_show = Danhmuc::with(['san_phams' => function ($query) {
            $query->limit(8);
        }])->where('danhmuc_id', 0)->get();
        return view('pages.contact', [
            "categories" => $categories,
            "new_products" => $new_products,
            "categories_show" =>$categories_show
        ]);
    }

    public function contact (Request $request) 
    {
        $lienhe = LienHe::create([
            'ten' => $request->ten,
            'email' => $request->email,
            'noidung' => $request->noidung,
            'trangthai' => 0,
            'user_id' => 1
        ]);     
        $categories = DanhMuc::with(['danh_muc_cha', 'san_phams', 'danh_muc_cons'])->get();
        $new_products = SanPham::limit(4)->get();
        $categories_show = Danhmuc::with(['san_phams' => function ($query) {
            $query->limit(8);
        }])->where('danhmuc_id', 0)->get();

        if(!$lienhe) 
            return view('pages.contact', [
                "categories" => $categories,
                "new_products" => $new_products,
                "categories_show" =>$categories_show,
                "error" => "Vui lòng thử lại !"
            ]);
        
        return view('pages.contact', [
            "categories" => $categories,
            "new_products" => $new_products,
            "categories_show" =>$categories_show,
            "success" => "Gửi liên hệ thành công !"
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keywork');
        
        $list_products = SanPham::where('tensanpham', 'like', '%'.$keyword.'%')->paginate(6);
        $categories = DanhMuc::with(['danh_muc_cha', 'san_phams', 'danh_muc_cons'])->get();
        $new_products = SanPham::limit(6)->get();
        return view('pages.search', [
            'list' => $list_products,
            "categories" => $categories,
            "new_products" => $new_products, 
            "keyword" => $keyword
        ]);
    }
}
