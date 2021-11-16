<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class baohanh_log extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey='bhMa';
    protected $table='baohanh_logs';
    protected $fillable=['bhMa','bhNgaytra','bhSdt','bhNoidung','serial','bhNgay','khMa','bhTinhtrang'];
}
