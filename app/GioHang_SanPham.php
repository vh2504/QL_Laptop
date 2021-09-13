<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GioHang_SanPham extends Model
{
    protected $table = 'giohang_sanphams';
    protected $primaryKey = 'giohang_id';
    
    protected $fillable = ['giohang_id', 'sanpham_id', 'soluong'];
    public $timestamps = false;

    public function sanpham()
    {
        return $this->belongsTo('App\SanPham', 'sanpham_id', 'id');
    }

}
