<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class donhang extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='donhang';
    protected $primaryKey='hdMa';
    protected $fillable=['hdMa','khMa','adMa','vcMa','hdSoluongsp','hdTongtien','hdBosung','hdTinhtrang','hdSdtnguoinhan','hdDiachi','hdGhichu','kmMa'];
}
