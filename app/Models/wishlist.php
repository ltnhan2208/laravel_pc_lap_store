<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wishlist extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='wishlist';
    protected $fillable=['khMa','spMa'];
}
