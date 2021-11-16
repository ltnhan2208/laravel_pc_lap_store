<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chitietthu extends Model
{
    use HasFactory;
    public $timesatmps=false;
    protected $table='chitietthu';
    protected $fillable=['thuMa','hdMa']
}
