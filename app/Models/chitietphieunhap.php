<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chitietphieunhap extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='chitietpheunhap';
    protected $fillable=['ctpnDongia','ctpnThanhtien','spMa','nccMa','pnMa','serMa'];
}
