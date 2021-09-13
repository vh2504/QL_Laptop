<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //NguoiDung - DonHang
        Schema::table('donhangs', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
        //NguoiDung - LienHe
        Schema::table('lienhes', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
        //NguoiDung - GioHang
        Schema::table('giohangs', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

        //SanPham - DanhMuc
        Schema::table('sanphams', function (Blueprint $table) {
            $table->foreign('danhmuc_id')->references('id')->on('danhmucs');
        });

        //SanPham - ChiTietDonHang - DonHang
        Schema::table('chitietdonhangs', function (Blueprint $table) {
            $table->foreign('sanpham_id')->references('id')->on('sanphams');
            $table->foreign('donhang_id')->references('id')->on('donhangs');

        });
        //GioHang - GioHang_SanPham - SanPham
        Schema::table('giohang_sanphams', function (Blueprint $table) {
            $table->foreign('giohang_id')->references('id')->on('giohangs');
            $table->foreign('sanpham_id')->references('id')->on('sanphams');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('sanphams', function (Blueprint $table) {
            $table->dropForeign(['sanphams']);
        });
        Schema::table('giohang_sanphams', function (Blueprint $table) {
            $table->dropForeign(['giohang_sanphams']);
        });
        Schema::table('chitietdonhangs', function (Blueprint $table) {
            $table->dropForeign(['chitietdonhangs']);
        });
        Schema::table('giohangs', function (Blueprint $table) {
            $table->dropForeign(['giohangs']);
        });
        Schema::table('lienhes', function (Blueprint $table) {
            $table->dropForeign(['lienhes']);
        });
        Schema::table('donhangs', function (Blueprint $table) {
            $table->dropForeign(['donhangs']);
        });
    }
}
