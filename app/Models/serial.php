<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class serial extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='serial';
    protected $fillable=['spMa','serMa','serTinhtrang'];
}
