<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thuonghieu extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='thuonghieu';
    protected $primaryKey='thMa';
    protected $fillable=['thMa','thTen'];
}
