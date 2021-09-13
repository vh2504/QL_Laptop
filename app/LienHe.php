<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LienHe extends Model
{
    protected $table = 'lienhes';

    protected $fillable = ['ten', 'email', 'noidung', 'trangthai', 'user_id'];
}
