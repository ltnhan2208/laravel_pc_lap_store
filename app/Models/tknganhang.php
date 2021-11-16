<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tknganhang extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table='tknganhang';
    protected $primaryKey='stk';
    protected $fillable=['stk','tennganhang','tenchuthe'];

}
