<?php

namespace App\Http\Controllers;

use App\DanhMuc;
use App\SanPham;
use Illuminate\Http\Request;

class DanhMucController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    public function showProductViaCategory($id)
    {
        $cate = DanhMuc::find($id);
        $categories = DanhMuc::with(['danh_muc_cha', 'san_phams', 'danh_muc_cons'])->get();
        $new_products = SanPham::limit(6)->get();
        return view('pages.product_via_category', [
            'cate' => $cate,
            "categories" => $categories,
            "new_products" => $new_products
        ]);
    }
}
