<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    protected $table = 'danhmucs';
    protected $fillable = [
        'ten', 'mota', 'danhmuc_id'
    ];

    /**
     * Get all of the comments for the DanhMuc
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function san_phams()
    {
        return $this->hasMany('App\SanPham', 'danhmuc_id', 'id');
    }

    public function danh_muc_cha() 
    {
        return $this->belongsTo('App\DanhMuc', 'danhmuc_id', 'id');
    }

    public function danh_muc_cons()
    {
        return $this->hasMany('App\DanhMuc', 'id', 'danhmuc_id');
    }
}
