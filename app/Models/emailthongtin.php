<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emailthongtin extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='emailthongtin';
    protected $fillable =['email'];

}
