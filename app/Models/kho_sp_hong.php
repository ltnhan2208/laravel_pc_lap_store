<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kho_sp_hong extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='kho_sp_hong';
    protected $fillable=['spMa','khoSlsphong'];
}
