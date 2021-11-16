<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chitietchi extends Model
{
    use HasFactory;
    public $timesatmps=false;
    protected $table='chitietchi';
    protected $fillable=['chiMa','hdMa']

}
