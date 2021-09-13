<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BaseDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //DonHang
        Schema::create('donhangs', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->timestamp('ngaydathang')->nullable();
            $table->timestamp('ngaygiaohang')->nullable();
            $table->integer('trangthai')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });

        //LienHe
        Schema::create('lienhes', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('ten')->nullable();
            $table->string('email')->nullable();
            $table->string('noidung')->nullable();
            $table->integer('trangthai')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });

        //ChiTietDonHang
        Schema::create('chitietdonhangs', function (Blueprint $table){
            $table->unsignedBigInteger('donhang_id')->nullable();
            $table->unsignedBigInteger('sanpham_id')->nullable();
            $table->integer('soluong')->nullable();
            $table->timestamps();
        });

        //DanhMuc
        Schema::create('danhmucs', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('ten')->nullable();
            $table->text('mota')->nullable();
            $table->unsignedBigInteger('danhmuc_id');
            $table->timestamps();
        });

        //SanPham
        Schema::create('sanphams', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('tensanpham')->nullable();
            $table->float('giaban')->nullable();
            $table->float('giasale')->nullable();
            $table->text('mota')->nullable();
            $table->text('anh')->nullable();
            $table->unsignedBigInteger('danhmuc_id');
            $table->unsignedBigInteger('giohang_id');
            $table->timestamps();
        });

        //GioHang
        Schema::create('giohangs', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->integer('soluong')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });

        //GioHang_SanPham
        Schema::create('giohang_sanphams', function (Blueprint $table){
            $table->unsignedBigInteger('giohang_id')->nullable();
            $table->unsignedBigInteger('sanpham_id')->nullable();
            $table->integer('soluong')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('giohangs');
        Schema::dropIfExists('sanphams');
        Schema::dropIfExists('danhmucs');
        Schema::dropIfExists('chitietdonhangs');
        Schema::dropIfExists('lienhes');
        Schema::dropIfExists('donhangs');
        Schema::dropIfExists('giohang_sanphams');
        //
    }
}
