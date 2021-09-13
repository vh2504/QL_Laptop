<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    protected $table = 'donhangs';
    
    protected $fillable = [
        'ngaydathang', 'ngaygiaohang', 'trangthai', 'user_id', 'more_info', 'created_at', 'updated_at'
    ];
}
