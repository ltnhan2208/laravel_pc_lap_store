<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phieunhap extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='phieunhap';
    protected $primaryKey='pnMa';
    protected $fillable=['pnMa','pnNgaylap','pnSoluongsp','pnTongtien'];
}
