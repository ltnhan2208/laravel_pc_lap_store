<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kho extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='kho';
    protected $fillable=['spMa','khSoluongsp','khoNgaynhap'];
}
