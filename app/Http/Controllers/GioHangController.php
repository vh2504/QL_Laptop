<?php

namespace App\Http\Controllers;

use App\DanhMuc;
use App\DonHang;
use App\GioHang;
use App\SanPham;
use App\ChiTietDonHang;
use App\GioHang_SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GioHangController extends Controller
{
    public function addProductToCart(Request $request, $product_id) 
    {
        $user = $request->user();
        $cart = GioHang::where('user_id', $user->id)->first();

        if(!$cart) {
            $new_cart = GioHang::create([
                'user_id' => $user->id,
                'soluong' => 0
            ]);

            GioHang_SanPham::create([
                'giohang_id' => $new_cart->id,
                'sanpham_id' => $product_id,
                'soluong' => 1
            ]);
        } else {
            $instance = GioHang_SanPham::where('giohang_id', $cart->id)
                                        ->where('sanpham_id', $product_id)
                                        ->first();
            if($instance) {
                $n = $instance->soluong + 1;
                // $instance->save();
                DB::table('giohang_sanphams')
                    ->where('giohang_id', $cart->id)
                    ->where('sanpham_id', $product_id)
                    ->update(['soluong' => $n]);
            } else {
                GioHang_SanPham::create([
                    'giohang_id' => $cart->id,
                    'sanpham_id' => $product_id,
                    'soluong' => 1
                ]);
            }
            
        }
        $all_cart = GioHang_SanPham::where('giohang_id', $cart->id)->get();
        $sl = 0;
        foreach($all_cart as $g_p) { 
            $sl += $g_p->soluong;
        }
        // $sl = GioHang_SanPham::where('giohang_id', $cart->id)->count();
        $cart->soluong = $sl;
        $cart->save();

        session_start();
        $product = SanPham::find($product_id);
        $message = 'Thêm sản phẩm '. $product->tensanpham .' vào giỏ hàng thành công';
        $_SESSION['cart_success'] = $message;
        return redirect()->route('home');
    }

    public function cartDetail(Request $request)
    {
        $user = $request->user();
        $cart = GioHang::where('user_id', $user->id)->first();
        $lists = GioHang_SanPham::where('giohang_id', $cart->id)
                                ->get();
        
        $categories = DanhMuc::with(['danh_muc_cha', 'san_phams', 'danh_muc_cons'])->get();
        $new_products = SanPham::limit(4)->get();
        $categories_show = Danhmuc::with(['san_phams' => function ($query) {
            $query->limit(8);
        }])->where('danhmuc_id', 0)->get();

        return view('pages.cart_detail', [
            "categories" => $categories,
            "new_products" => $new_products,
            "categories_show" =>$categories_show,
            "list_products" => $lists
        ]);
    }

    public function deleteProduct(Request $request, $giohang_id, $sanpham_id) 
    {   
        $sl = DB::table('giohang_sanphams')
            ->where('giohang_id', $giohang_id)
            ->where('sanpham_id', $sanpham_id)
            ->first()->soluong;
        DB::table('giohang_sanphams')
            ->where('giohang_id', $giohang_id)
            ->where('sanpham_id', $sanpham_id)
            ->delete();

        $giohang = DB::table('giohangs')
            ->where('user_id', $request->user()->id)
            ->first();
        $soluong = $giohang->soluong - $sl;
        DB::table('giohangs')
            ->where('user_id', $request->user()->id)
            ->update(['soluong' => $soluong]);
        $sp = SanPham::find($sanpham_id);

        $message = 'Xóa thành công sản phẩm ' . $sp->tensanpham . ' khỏi giỏ hàng .';
        return redirect()->route('cart-detail')->with('message_delete', $message);
    }

    public function updateCart(Request $request)
    {
        $cart_id = 0;
        foreach($request->all() as $key => $r)
        {
            $item = explode('-', $key);
            if($item[0] == 'soluong') {
                $cart_id = $item[2];
                $sanpham_id = $item[1];
                $giohang_id = $item[2];
                if((int)$r > 0) {
                    DB::table('giohang_sanphams')
                    ->where('giohang_id', $giohang_id)
                    ->where('sanpham_id', $sanpham_id)
                    ->update(['soluong' => (int)$r]);
                } else {
                    DB::table('giohang_sanphams')
                        ->where('giohang_id', $giohang_id)
                        ->where('sanpham_id', $sanpham_id)
                        ->delete();
                }
            }
        }
        $all_cart = GioHang_SanPham::where('giohang_id', $cart_id)->get();
        $sl = 0;
        foreach($all_cart as $g_p) { 
            $sl += $g_p->soluong;
        }

        $cart = GioHang::where('user_id', $request->user()->id)->first();
        $cart->soluong = $sl;
        $cart->save();

        $message = 'Cập nhật giỏ hàng thành công!';
        return redirect()->route('cart-detail')->with('message_update', $message);
    }

    public function datHang($id)
    {
        $categories = DanhMuc::with(['danh_muc_cha', 'san_phams', 'danh_muc_cons'])->get();
        $new_products = SanPham::limit(4)->get();
        $categories_show = Danhmuc::with(['san_phams' => function ($query) {
            $query->limit(8);
        }])->where('danhmuc_id', 0)->get();

        $product_info = SanPham::find($id);
        return view('pages.dathang', [
            "categories" => $categories,
            "new_products" => $new_products,
            "categories_show" =>$categories_show,
            'product' => $product_info
        ]);
    }

    public function handleDatHang(Request $request, $product_id)
    {
        $name = $request->name;
        $note = $request->note;
        $address = $request->address;
        $phone = $request->phone;

        $data_more = json_encode([
            'name' => $name,
            'note' => $note,
            'address' => $address,
            'phone' => $phone
        ]);

        $order = DonHang::create([
            'ngaydathang' => date('Y-m-d H:i:s', time()),
            'trangthai' => 0,
            'user_id' => $request->user()->id,
            'more_info' => $data_more
        ]);

        ChiTietDonHang::create([
            'donhang_id' => $order->id,
            'sanpham_id'   =>$product_id,
            'soluong' => 1
        ]);
        $message = 'Đặt hàng thành công';

        return redirect()->route('home')->with('dathang_success', $message);
    }

    public function datHangFromCart(Request $request)
    {
        $categories = DanhMuc::with(['danh_muc_cha', 'san_phams', 'danh_muc_cons'])->get();
        $new_products = SanPham::limit(4)->get();
        $categories_show = Danhmuc::with(['san_phams' => function ($query) {
            $query->limit(8);
        }])->where('danhmuc_id', 0)->get();

        $cart = $request->user()->gio_hang;
        $product_cart = GioHang_SanPham::where('giohang_id', $cart->id)->get();

        return view('pages.dathangfromcart', [
            "categories" => $categories,
            "new_products" => $new_products,
            "categories_show" =>$categories_show,
            'product_cart' => $product_cart
        ]);
    }

    public function handleDatHangFromCart(Request $request)
    {
        $name = $request->name;
        $note = $request->note;
        $address = $request->address;
        $phone = $request->phone;

        $data_more = json_encode([
            'name' => $name,
            'note' => $note,
            'address' => $address,
            'phone' => $phone
        ]);

        $order = DonHang::create([
            'ngaydathang' => date('Y-m-d H:i:s', time()),
            'trangthai' => 0,
            'user_id' => $request->user()->id,
            'more_info' => $data_more
        ]);

        $cart = $request->user()->gio_hang;
        $product_cart = GioHang_SanPham::where('giohang_id', $cart->id)->get();
        foreach($product_cart as $value) {
            ChiTietDonHang::create([
                'donhang_id' => $order->id,
                'sanpham_id'   =>$value->sanpham_id,
                'soluong' => $value->soluong
            ]);

            $value->delete();
        }
        $all_cart = GioHang_SanPham::where('giohang_id', $cart->id)->get();
        $sl = 0;
        foreach($all_cart as $g_p) { 
            $sl += $g_p->soluong;
        }
        $cart->soluong = $sl;
        $cart->save();

        $message = 'Đặt hàng thành công';

        return redirect()->route('home')->with('dathang_success', $message);
    }
}
