<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class baocao extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='baocao';
    protected $primaryKey='bcMa';
    protected $fillable=['bcMa','bcTonghangxuat','bcTonghangnhap','bcThu','bcChi','bcTonkho','bcNgaylap','bcGhichu','adMa'];
}
