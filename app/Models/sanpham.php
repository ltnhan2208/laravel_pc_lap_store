<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sanpham extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='sanpham';
    protected $primaryKey='spMa';
    protected $fillable=['spMa','spTen','spGia','spTinhtrang','spHanbh','spTinhtrang','kmMa','ncMa','loaiMa','thMa','spSlkmtoida','spImei'];
}
