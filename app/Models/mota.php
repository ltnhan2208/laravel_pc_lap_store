<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mota extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='mota';
    protected $fillable=['spMa','ram','cpu','ocung','psu','vga','mainboard','manhinh','chuot','banphim','vocase','pin','tannhiet','loa','mau','trongluong','conggiaotiep','webcam','chuanlan','chuanwifi','hedieuhanh'];
}
