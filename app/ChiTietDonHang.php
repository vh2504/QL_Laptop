<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
    protected $table = 'chitietdonhangs';
    
    protected $fillable = [
        'donhang_id', 'sanpham_id', 'soluong', 'created_at','updated_at'
    ];
}
