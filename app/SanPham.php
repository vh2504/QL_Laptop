<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    protected $table = 'sanphams';
    
    protected $fillable = [
        'tensanpham', 'giaban', 'giasale', 'mota', 'anh', 'danhmuc_id', 'giohang_id'
    ];

    public function danh_muc()
    {
        return $this->belongsTo('App\DanhMuc', 'id', 'danhmuc_id');
    }
}
