<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thu extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='thu';
    protected $primaryKey='thuMa'
    protected $fillable=['thuMa','thuNgaylap','thuNgaybd','thuNgaykt','thuSoluongsp','thuTongtien','thuGhichu','adMa'];;
}
