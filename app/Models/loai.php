<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loai extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='loai';
    protected $primaryKey='loaiMa';
    protected $fillable=['loaiMa','loaiTen'];
    
}
