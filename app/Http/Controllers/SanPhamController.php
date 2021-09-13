<?php

namespace App\Http\Controllers;

use App\DanhMuc;
use App\SanPham;
use Illuminate\Http\Request;

class SanPhamController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    public function list()
    {
        $list_products = SanPham::paginate(6);
        $categories = DanhMuc::with(['danh_muc_cha', 'san_phams', 'danh_muc_cons'])->get();
        $new_products = SanPham::limit(6)->get();
        return view('pages.list_products', [
            'list' => $list_products,
            "categories" => $categories,
            "new_products" => $new_products
        ]);
    }
}
