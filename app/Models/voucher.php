<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class voucher extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='voucher';
    protected $primaryKey='vcMa';
    protected $fillable=['vcMa','vcTen','vcTinhtrang','vcSoluot','vcLoai','vcNgaybt','vcNgaykt','vcLoaiGiamgia','vcMucgiam','vcGiatritoida','vcDkapdung','vcGtcandat','spMa'];
}
