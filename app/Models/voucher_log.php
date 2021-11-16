<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class voucher_log extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='voucher_log';
    protected $fillable=['vcgSolan','vcMa','kmMa'];
}
