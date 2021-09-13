<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GioHang extends Model
{
    //
    protected $table = 'giohangs';
    protected $fillable = ['user_id', 'soluong'];
}
